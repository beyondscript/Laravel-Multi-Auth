<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;

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

    use AuthenticatesUsers, ThrottlesLogins;

    public function customlogin(Request $request){
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = array();
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        $credentials['remember'] = $request->remember;
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if (Auth::attempt($credentials, $remember)) {
            if(Auth::user()->type == 'Admin'){
                return redirect()->route('admin.home');
            }
            else if(Auth::user()->type == 'Pro'){
                return redirect()->route('pro.home');
            }
            else if(Auth::user()->type == 'User'){
                return redirect()->route('user.home');
            }
        }
        else{
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
