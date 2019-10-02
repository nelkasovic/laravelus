<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Person;
use App\User;
use Auth;
use Lang;

class PersonController extends Controller
{
    private $mail;

    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:user|person');
        $this->middleware('permission:read persons');
        $this->settings = new SettingController;
        $this->mail = new MailController;
    }

    /**
     * Person list.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $tenant = Auth()->user()->hasRole('tenant');
        $selected_role = $request->role;

        try {
            $keyword = $request->input('keyword');
            $persons = Auth::user()->tenant
                    ->persons()
                    ->when($selected_role, function ($q) use ($selected_role) {
                        $q->whereHas('roles', function ($w) use ($selected_role) {
                            $w->where('name', $selected_role);
                        });
                    })
                    ->search($keyword)
                    ->sortable(['updated_at' => 'desc'])
                    ->paginate($request->show)
                    ->onEachSide(1);
            

            $total = $persons->total();
            $show = $persons->perPage();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            $message = $e->getMessage();

            return back()->withError($message)->withInput();
        }

        /**
         * Check if request is AJAX or not.
         */
        if ($request->ajax()) {
            $data = [
                    'status' => 200,
                    'success' => true,
                    'result' => $tenant->persons->toArray()
                ];
                
            return response()->json($data);
        }

        return view(
            'persons',
            [
                'selected_role' => $selected_role,
                'persons' => $persons,
                'show' => $show,
                'total' => $total,
                'keyword' => $keyword,
            ]
        );
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
        $data['tenant_id'] = Auth()->user()->tenant->id;

        /*
         * If a person changes his own record, set flag changed to true.
         * The idea is to know which records have changed but not from an admin/user account.
         */
        $data['changed'] = 1;
        /*
         * If the user has user role or higher set flag back to zero.
         * That means, admin has changed and approved the changes.
         */
        if (Auth()->user()->hasRole('manager')) {
            $data['changed'] = 0;
        }

        $msg = Lang::get('common.AddSuccess');
        $status = true;

        $this->validate($request, [
            'salutation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif',
            'email' => 'unique:persons,email'

        ]);

        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                $picture = time() . '_' . strtolower(preg_replace('/\s+/', '', $request->get('last_name'))) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/images/', $picture);
                $data['picture'] = $picture;
            }

            $person = new Person($data);
            $this->authorize('create', $person);
            $person->save();

            // Attach meta fields
            if ($person) {
                foreach ($request->meta as $key => $value) {
                    if ($value) {
                        $person->setMeta($key, $value);
                    }
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $status = false;

            return back()->withError($message)->with('status', $status)->withInput();
        }

        return redirect('persons')
            ->with('status', true)
            ->with('msg', Lang::get('common.StoreSuccess'))
            ->with('response', $person)
            ->with('json', response()->json($person));
    }

    /**
     * Person create.
     *
     * @return void
     */
    public function create()
    {
        try {
            $person = new Person();
            //$periods = Auth()->user()->tenant->periods;
            $studies = Auth()->user()->tenant->studies;
            $this->authorize('create', $person);
            $action = 'create';

            return view('persons', compact('person', 'action', 'studies'));
        } catch (\Exception $e) {
            //abort(403, 'Unauthorized action.');
            //dd($e);
            $message = $e->getMessage();

            return back()->withError($message)->withInput();
        }
    }

    /**
     * Assign person to courses.
     *
     * @return void
     */
    public function courses($id)
    {
        try {
            $person = Person::findOrFail($id);
            $all_persons = Auth()->user()->tenant->persons;
            $all_courses = Auth()->user()->tenant->courses;
            $assigned_courses = $person->courses;
            $action = 'courses';

            return view('persons', compact('person', 'id', 'action', 'all_persons', 'all_courses', 'show', 'assigned_courses'));
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return back()->withError($message)->withInput();
        }
    }

    /**
     * Person show.
     *
     * @return void
     */
    public function show($id)
    {
        try {
            $person = Person::findOrFail($id);
            $this->authorize('view', $person);
            //$periods = Auth()->user()->tenant->periods;
            $studies = Auth()->user()->tenant->studies;
            $action = 'readonly';

            return view('persons', compact('person', 'id', 'studies', 'action'));
        } catch (\Exception $e) {
            $message = $e->getMessage();

            return back()->withError($message)->withInput();
        }
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

        /*
         * If a person changes his own record, set flag changed to true.
         * The idea is to know which records have changed but not from an admin/user account.
         */
        $data['changed'] = 1;
        /*
         * If the user has user role or higher set flag back to zero.
         * That means, admin has changed and approved the changes.
         */
        if (Auth()->user()->hasRole('manager')) {
            $data['changed'] = 0;
        }

        $msg = Lang::get('common.UpdateSuccess');
        $status = true;

        // Validate data
        $request->validate([
            'salutation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif',
            'email' => 'unique:persons,email'
        ]);

        $data['tenant_id'] = Auth::user()->tenant->id;
        $study = ($request->study_id) ? Study::findOrFail($request->study_id) : null;
        $data['period_id'] = ($study) ? $study->period->id : Auth::user()->tenant->periods()->where('active', 1)->where('global', 1)->pluck('id')->first();
        
        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                //$picture = time().$file->getClientOriginalName();
                $picture = time() . '_' . strtolower(preg_replace('/\s+/', '', $request->get('last_name'))) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/images/', $picture);
                $data['picture'] = $picture;
            }

            $person = Person::findOrFail($id);
            $this->authorize('update', $person);
            $person->update($data);
            $person->studies()->attach($study);

            // Attach meta fields
            if ($person) {
                foreach ($request->meta as $key => $value) {
                    if ($value) {
                        $person->setMeta($key, $value);
                    } elseif ($person->getMeta($key)) {
                        $person->removeMeta($key);
                    }
                }
            }

            return back();
            return redirect('persons')
                ->with('status', $status)
                ->with('msg', $msg)
                ->with('response', $person)
                ->with('json', response()->json($person));
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $status = false;

            return back()->withError($msg)->withInput();
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
            $person = Person::findOrFail($id);
            //$this->authorize('delete', $person);
            //$user->delete();

            $picture = $person->picture;
            @unlink(public_path() . '/images/' . $picture);
            $person->delete();

            return redirect('persons')->with('msg', $msg)->with('status', true);
        } catch (\Exception $e) {
            $msg = $e->getMessage();


            if ($e->getCode() === '23000') {
                $msg = Lang::get('common.DataUsed');
            }


            return back()->withError($msg)->withInput()->with('status', false);
        }
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
        $action = 'edit';

        try {
            $person = Person::findOrFail($id);
            $studies = Auth()->user()->tenant->studies;
            $this->authorize('update', $person);

            return view('persons', compact('id', 'person', 'studies', 'action'));
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->withInput();
        }
    }


    /**
     * Approve a person after all data is checked.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->approved = 1;
            $person->changed = 0;
            $person->update();
            $this->authorize('update', $person);

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withError($msg)->withInput();
        }
    }

    /**
     * Disapprove a person while data is not up to date.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function disapprove($id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->approved = 0;
            $person->changed = 0;
            $person->update();
            $this->authorize('update', $person);

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withError($msg)->withInput();
        }
    }

    public function user($pid)
    {
        try {
            if (!$this->hasUser($pid)) {
                $tenant = Auth()->user()->tenant;
                
                // Check if initial passwort exists, set one if not!
                if (!$tenant->getMeta('initial_password')) {
                    $tenant->setMeta('initial_password', 'Staff87#');
                }

                // Use initial password for the user.
                $password = $tenant->getMeta('initial_password');
                
                // Find person.
                $person = Person::findOrFail($pid);

                // Create empty user.
                $user = new User;

                // Check if user can be created?
                $this->authorize('create', $user);

                // Add some attributes.
                $user->tenant_id = $person->tenant_id;
                $user->description = $person->title . ' ' . $person->company_name;
                $user->name = $person->first_name . ' ' . $person->last_name;
                $user->email = $person->email;
                $user->password = bcrypt($password);

                // Store tue user.
                $user->save();

                // Assign a role for the new user (noob can only see the own profile page)!
                $user->assignRole('noob');

                // Feedback to the view.
                $msg = Lang::get('common.AddSuccess') . ' | ' . Lang::get('common.Email') . ': ' . $user->email . ' | ' . Lang::get('common.Password') . ': ' . $password;

                if (config('app.env') === 'production') {
                    // Send notification via email only if enabled on production.
                    if ($tenant->getMeta('notify_person_to_user')) {
                        $this->mail->userForPersonCreated($person, $user, $tenant);
                    }
                }

                return redirect('persons')->with('status', true)->with('msg', $msg);
            }
            return redirect('persons')->with('status', false)->with('msg', Lang::get('common.UserForPersonExistsAlready'));
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            if ($e->getCode() === '23000') {
                $msg = Lang::get('common.ConstraintViolation');
            }

            return back()->withErrors($msg);
        }
    }

    public function hasUser($pid)
    {
        //return User::where('person_id', $pid)->pluck('id')->first();
    }
}
