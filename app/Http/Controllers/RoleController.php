<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Lang;

class RoleController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     */
    public function __construct()
    {
        $this->middleware('role:super');
        //$this->middleware('permission:read roles');
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
            $roles = Role::paginate($request->show)->onEachSide(1);

            $total = $roles->total();
            $show = $roles->perPage();

            return view(
                'roles',
                [
                    'roles' => $roles,
                    'show' => $show,
                    'total' => $total,
                    'keyword' => $keyword,
                ]
            );
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $role = new Role();
            //$this->authorize('create', $role);
            $action = 'create';
            $permission = Permission::get();

            return view('roles', compact('action', 'role', 'permission'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('roles')->withError($message)->withInput();
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        try {
            $role = new Role([
                'name' => $request->name,
            ]);
            //$this->authorize('create', $role);
            $role->save();
            $role->syncPermissions($request->permission);

            return redirect('roles')
                ->with('status', true)
                ->with('msg', Lang::get('common.StoreSuccess'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $msg = $exception->getMessage();

            return redirect('rooms')->withError($msg)->withInput();
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
        try {
            $role = Role::findOrFail($id);
            $permissions = $role->getAllPermissions();
            //$this->authorize('view', $role);
            $action = 'readonly';

            return view('roles', compact('role', 'id', 'permissions', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('roles')->withError($message)->withInput();
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
        try {
            $role = Role::findOrFail($id);
            //$this->authorize('update', $role);
            $permission = Permission::get();
            $permissions = $role->getAllPermissions();

            $action = 'edit';

            return view('roles', compact('role', 'id', 'permission', 'permissions', 'action'));
        } catch (\Illuminate\Database\QueryException $exception) {
            //abort(403, 'Unauthorized action.');
            //dd($exception);
            $message = $exception->getMessage();

            return redirect('roles')->withError($message)->withInput();
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        try {
            $role = Role::findOrFail($id);
            //$this->authorize('update', $role);
            $role->name = $request->name;
            $role->update();
            $role->syncPermissions($request->permission);

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return redirect('roles')->withError($msg)->withInput();
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
        try {
            $role = Role::findOrFail($id);
            //$this->authorize('delete', $role);
            $role->delete();

            return back();
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return back()->withError($msg)->with('status', false);
        }
    }
}
