<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tenant;
use Lang;

class TenantController extends Controller
{
    private $settings;
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:admin');
        $this->middleware('permission:create users');
        $this->settings = new SettingController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $active = Tenant::where('active', 1)->search($keyword)->sortable()->paginate($request->show)->onEachSide(1);
            $inactive = Tenant::where('active', 0)->search($keyword)->sortable()->paginate($request->show)->onEachSide(1);
            $total = $active->total();
            $show = $active->perPage();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            abort($e);
        }

        return view(
            'tenants',
            [
                'active' => $active,
                'inactive' => $inactive,
                'show' => $show,
                'total' => $total,
                'keyword' => $keyword,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tenant = new Tenant();
        $this->authorize('create', $tenant);
        $action = 'create';

        return view('tenants', compact('tenant', 'action'));
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
        $msg = Lang::get('common.AddSuccess');
        $status = true;

        // Validate data
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif',
        ]);

                
        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                $picture = time().'_'.strtolower(preg_replace('/\s+/', '', $request->get('name'))).'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/images/', $picture);
                $data['picture'] = $picture;
            }

            $tenant = new Tenant($data);
            $this->authorize('create', $tenant);
            $tenant->save();
            $tenant->syncMeta($tenant->settings);

        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return redirect('tenants')
            ->with('status', true)
            ->with('settings', $this->settings)
            ->with('msg', Lang::get('common.StoreSuccess'));
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
        $tenant = Tenant::findOrFail($id);
        $this->authorize('view', $tenant);
        $action = 'readonly';

        return view('tenants', compact('tenant', 'id', 'action'));
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
        $msg = '';
        try {
            $tenant = Tenant::findOrFail($id);
            $this->authorize('update', $tenant);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        $action = 'edit';

        return view('tenants', compact('id', 'tenant', 'action', 'msg'));
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
        $msg = Lang::get('common.UpdateSuccess');
        $status = true;

        // Validate data
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif',
        ]);

        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                //$picture = time().$file->getClientOriginalName();
                $picture = time().'_'.strtolower(preg_replace('/\s+/', '', $request->get('name'))).'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/images/', $picture);
                $data['picture'] = $picture;
            }

            $tenant = Tenant::findOrFail($id);
            $this->authorize('update', $tenant);
            $tenant->update($data);


        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return redirect('tenants')
            ->with('status', $status)
            ->with('msg', $msg);
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
            $tenant = Tenant::findOrFail($id);

            /*
             * Check tenant policies if user is authorized
             */
            $this->authorize('delete', $tenant);
            //$tenant->delete();
            $tenant->active = 0;
            $tenant->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            if ($e->getCode() === '23000') {
                $msg = Lang::get('common.DataUsed');
            }
        }

        return redirect('tenants')->with('msg', $msg);
    }

    /**
     * Enable the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function enable($id)
    {
        $msg = Lang::get('common.UpdateSuccess');

        try {
            $tenant = Tenant::findOrFail($id);

            /*
             * Check tenant policies if user is authorized
             */
            $this->authorize('update', $tenant);
            //$tenant->delete();
            $tenant->active = 1;
            $tenant->save();

            return redirect('tenants');
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return redirect('tenants')->with('msg', $msg)->with('status', false);
        }
    }

    /**
     * Disable the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $msg = Lang::get('common.UpdateSuccess');

        try {
            $tenant = Tenant::findOrFail($id);

            /*
             * Check tenant policies if user is authorized
             */
            $this->authorize('update', $tenant);
            //$tenant->delete();
            $tenant->active = 0;
            $tenant->save();

            return redirect('tenants');
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return redirect('tenants')->with('msg', $msg)->with('status', false);
        }
    }
}
