<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Client;
use App\Person;
use Lang;

class LocationController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:user|person');
        $this->middleware('permission:read locations');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = Auth()->user()->hasRole('admin');
        $user = Auth()->user()->hasRole('user');
        $person = Auth()->user()->hasRole('person');
        $client = Auth()->user()->client;

        try {
            $keyword = $request->input('keyword');

            if ($admin) {
                $locations = Location::search($keyword)
                    ->sortable(['updated_at' => 'desc'])
                    ->paginate($request->show)
                    ->onEachSide(1);
            } elseif ($user && !$admin) {
                $locations = $client->locations()
                    ->search($keyword)
                    ->sortable(['updated_at' => 'desc'])
                    ->paginate($request->show)
                    ->onEachSide(1);
            } elseif ($person) {
                $locations = Person::findOrFail(Auth()->user()->person_id)->locations()
                    ->search($keyword)
                    ->sortable(['updated_at' => 'desc'])
                    ->paginate($request->show)
                    ->onEachSide(1);
            }

            $total = $locations->total();
            $show = $locations->perPage();

            return view(
                'locations',
                [
                    'locations' => $locations,
                    'show' => $show,
                    'total' => $total,
                    'keyword' => $keyword,
                ]
            );
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            $message = $e->getMessage();

            return back()->withError($message)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id)
    {
        try {
            $location = new Location();
            $this->authorize('create', $location);
            $models = ['App\Client', 'App\Room', 'App\Person'];
            $action = 'create';

            return view('locations', compact('location', 'models', 'type', 'id', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource of type Person.
     *
     * @return \Illuminate\Http\Response
     */
    public function person($locationable_id, $person_id = null)
    {
        $admin = Auth()->user()->hasRole('admin');
        $user = Auth()->user()->hasRole('user');
        $person = Auth()->user()->hasRole('person');
        $noob = Auth()->user()->hasRole('noob');

        $action = ($person_id) ? 'edit' : 'create';
        $location = ($person_id) ? Location::findOrFail($locationable_id) : new Location();
        $collection = $this->types();

        if ($admin) {
            $types = Person::all();
        } elseif ($user) {
            $types = Auth()->user()->client->persons;
        } else {
            $types = Auth()->user()->person()->get();
        }

        try {
            $locationable_type = 'App\Person';

            return view('locations', compact('location', 'locationable_type', 'locationable_id', 'types', 'collection', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource of type Person.
     *
     * @return \Illuminate\Http\Response
     */
    public function client($locationable_id, $client_id = null)
    {
        $action = ($client_id) ? 'edit' : 'create';
        $location = ($client_id) ? Location::findOrFail($locationable_id) : new Location();
        $collection = $this->types();

        try {
            $types = Client::all();
            $locationable_type = 'App\Client';

            return view('locations', compact('location', 'locationable_type', 'locationable_id', 'types', 'collection', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource of type Person.
     *
     * @return \Illuminate\Http\Response
     */
    public function room($locationable_id, $room_id = null)
    {
        $action = ($room_id) ? 'edit' : 'create';
        $location = ($room_id) ? Location::findOrFail($locationable_id) : new Location();
        $collection = $this->types();

        try {
            $types = Auth()->user()->client->rooms;
            $locationable_type = 'App\Room';

            return view('locations', compact('location', 'locationable_type', 'locationable_id', 'collection', 'types', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['client_id'] = Auth()->user()->client->id;

        $this->validate($request, [
            'street' => 'required',
            'street_number' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'locationable_type' => 'required',
        ]);

        try {
            if (!Auth()->user()->hasRole('user')) {
                $data['approved'] = 0;
            }

            $location = new Location($data);
            $this->authorize('update', $location);
            $location->save();

            switch ($data['locationable_type']) {
                case 'App\Person':
                    $action = 'PersonController@show';
                    break;
                case 'App\Room':
                    $action = 'RoomController@show';
                    break;
                case 'App\Client':
                    $action = 'ClientController@show';
                    break;
                default:
                    $action = 'LocationController@index';
                    break;
            }

            //return redirect($view)->with('msg', Lang::get('common.UpdateSuccess'))->with('status', true);
            return redirect()->action($action, ['id' => $data['locationable_id']]);
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return back()->withError($message)->with('status', false);

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        $this->authorize('view', $location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $this->validate($request, [
            'street' => 'required',
            'street_number' => 'required',
            'zip' => 'required',
            'city' => 'required',
        ]);

        try {
            $location = Location::findOrFail($id);
            $this->authorize('update', $location);

            if (!Auth()->user()->hasRole('user')) {
                $data['approved'] = 0;
            }

            $location->update($data);

            switch ($location->locationable_type) {
                case 'App\Person':
                    $action = 'PersonController@show';
                    break;
                case 'App\Room':
                    $action = 'RoomController@show';
                    break;
                case 'App\Client':
                    $action = 'ClientController@show';
                    break;
                default:
                    $action = 'LocationController@index';
                    break;
            }

            //return redirect($view)->with('msg', Lang::get('common.UpdateSuccess'))->with('status', true);
            return redirect()->action($action, ['id' => $location->locationable_id]);
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return back()->withError($message)->with('status', false);

            return redirect('locations')->withError($message)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = Lang::get('common.DeleteSuccess');

        try {
            /**
             * Find location.
             */
            $location = Location::findOrFail($id);
            $this->authorize('delete', $location);

            /*
             * Set a new location to be default if the old one was default.
             */
            if ($location->default === 1) {
                $this->authorize('update', $location);
                $new = $location->locationable->locations()->first();
                $new->default = 1;
                $new->update();
            }

            /*
             * Remove location.
             */
            $location->destroy($id);

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->withInput();
        }
    }

    /**
     * Set default location.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function default($lid)
    {
        $msg = Lang::get('common.UpdateSuccess');

        try {
            $location = Location::findOrFail($lid);
            $this->authorize('update', $location);
            $locations = $location->locationable->locations()->get();

            /*
             * Remove all other defaults since only one can be default.
             */
            $locations->each(function ($loc) {
                $loc->default = 0;
                $loc->update();
            });

            $location->default = 1;
            $location->update();

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->withInput();
        }
    }

    public function types()
    {
        /**
         * Get all address types like business or private.
         */
        $types = Location::all()->pluck('type')->unique();

        /**
         * Get translations.
         */
        $collection = $types->mapWithKeys(function ($item) {
            return [$item => Lang::get("dynamic.{$item}")];
        });

        return $collection;
    }
}
