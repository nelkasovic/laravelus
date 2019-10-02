<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Register a new user
     *
     * @return Redirect
     */
    public function register() {
        if (Request::isMethod('post')) {
            User::create([
                        'name' => Request::get('name'),
                        'email' => Request::get('email'),
                        'password' => bcrypt(Request::get('password')),
            ]);
        } 
        
        return Redirect::away('auth.login');
    }
    
    /**
     * Do authentication 
     *
     * @return view
     */
    public function authenticate() {
        $remember = Request::get('remember') == 'on' ? 1 : 0;
        
        if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')], $remember)) {
            $user = Auth::user();
            $user->last_login = Carbon::now()->format('Y.m.d H:i:s');
            $user->update();
            
            \App::setLocale(LC_ALL, $user->locale);

            // Get client settings
            // $settings = Auth()->user()->client->getAllMeta()->toArray();

            // Store settings to session
            // Request::session()->put('settings', $settings);
           
            if($user->person->approved) {
                return redirect()->intended('dashboard');
            }

            return redirect()->action('PersonController@edit', $user->person_id)->with('approval', Lang::get('common.MissingDataForApproval'));

        } else {
            //return view('auth.login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
            //return redirect('login')->withErrors($validator, 'login');
            return redirect()->back()->withErrors(['password', 'The Message']);
            //Redirect::back()->withErrors(['password', 'The Message']);
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::away('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function password()
    {
        return view('auth.password.request');
    }
}
