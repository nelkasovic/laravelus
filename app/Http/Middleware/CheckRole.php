<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Auth;
use Flash;
use Lang;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Role $role
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user has a role
        //$request->user()->authorizeRoles($role);

        $roles = array_slice(func_get_args(), 2); // [default, admin, manager]

        foreach ($roles as $role) {

            try {

                Role::whereName($role)->firstOrFail(); // make sure we got a "real" role
    
                if (Auth::user()->hasRole($role)) {
                    return $next($request);
                }
    
            } catch (ModelNotFoundException $exception) {
    
                dd('Could not find role ' . $role);
    
            }
        }
    
        //Flash::warning('Access Denied', 'You are not authorized to view that content.'); // custom flash class
        // https://github.com/laracasts/flash
    
        return redirect('/')->with('msg', Lang::get('common.NoPermission')); 

        //return $next($request);
    }
}
