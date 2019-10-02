<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\User;
use App\Tenant;
use Lang;

class UserController extends Controller
{
    /**
     * Create a new controller instance with authentication.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('role:admin');
        $this->middleware('permission:read users');
    }

    /**
     * Users list.
     *
     * @return void
     */
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $selected_tenant = intval($request->tenant_id);
            $admin = Auth()->user()->hasRole('admin');

            $tenant = ($selected_tenant) ? Tenant::findOrFail($selected_tenant) : Auth()->user()->tenant;
            $users = $tenant->users()->search($keyword)->sortable()->paginate($request->show)->onEachSide(1);
            $tenants = Tenant::all();

            $total = $users->total();
            $show = $users->perPage();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            abort($e);
        }

        return view(
            'users',
            [
                'users' => $users,
                'tenants' => $tenants,
                'action' => 'index',
                'show' => $show,
                'total' => $total,
                'keyword' => $keyword,
                'selected_tenant' => $selected_tenant,
            ]
        );
    }

    /**
     * Person create.
     *
     * @return void
     */
    public function create()
    {
        try {
            $user = new User();
            $this->authorize('create', $user);
            $roles = Role::all();
            $action = 'create';
        } catch (\Exception $e) {
            //abort($e->getMessage());
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return view('users', compact('user', 'action', 'roles'));
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
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'image_url' => 'mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                $picture = time().'_'.strtolower(preg_replace('/\s+/', '', $request->get('name'))).'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/images/user/', $picture);
                $data['image_url'] = $picture;
            }

            $user = new User($data);
            $this->authorize('create', $user);
            $user->save();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $status = false;
        }

        return redirect('users')
            ->with('status', $status)
            ->with('msg', $msg);
        //->with('response', $user)
        //->with('json', response()->json($user));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $msg = Lang::get('common.UpdateSuccess');
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        // Validate data
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'image_url' => 'mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            if ($request->hasfile('picture')) {
                $file = $request->file('picture');
                $picture = time().'_'.strtolower(preg_replace('/\s+/', '', $request->get('name'))).'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/images/user/', $picture);
                $data['image_url'] = $picture;
            }

            $user->update($data);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return redirect()->route('users.edit', $user->id)
            ->with('status', true)
            ->with('msg', $msg);
    }

    /**
     * User show.
     *
     * @return void
     */
    public function roles($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('read', $user);
        $action = 'roles';

        return view('users', compact('user', 'id', 'action'));
    }

    /**
     * User show.
     *
     * @return void
     */
    public function reset($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('read', $user);
        $action = 'reset';

        return view('users', compact('user', 'id', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request, $id)
    {
        $data = $request->all();
        $msg = Lang::get('common.UpdateSuccess');
        $user = User::findOrFail($id);

        // Validate data
        $validator = Validator::make($data, [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            $data['password'] = bcrypt($request->password);
            $data['password_confirmation'] = bcrypt($request->password);

            $user->update($data);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return redirect('users')
            ->with('status', true)
            ->with('msg', $msg);
    }

    /**
     * User show.
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        $roles = Role::all();
        $action = 'readonly';

        return view('users', compact('user', 'id', 'roles', 'action'));
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
            $user = User::findOrFail($id);
            $this->authorize('delete', $user);

            if ($user->persons->count() > 0) {
                $msg = Lang::get('common.DataUsed').' | '.Lang::get('common.Persons');
            } elseif ($user->events->count() > 0) {
                $msg = Lang::get('common.DataUsed').' | '.Lang::get('common.Events');
            } elseif ($user->scripts->count() > 0) {
                $msg = Lang::get('common.DataUsed').' | '.Lang::get('common.Scripts');
            } else {
                $image_url = $user->image_url;
                @unlink(public_path().'/images/'.$image_url);
                $user->delete();
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return back()->withErrors($msg);
        }

        return redirect('users')->with('msg', $msg);
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
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $roles = Role::all();
        $action = 'edit';

        return view('users', compact('id', 'user', 'action', 'roles'));
    }
}
