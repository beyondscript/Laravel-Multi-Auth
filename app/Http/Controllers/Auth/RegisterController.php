<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showProRegistrationForm()
    {
        return view('auth.pro_register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){
        if(isset($request->type) && $request->type == 'Pro'){
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:users'],
                'image' => ['image'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else{
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'image' => ['image'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user = new User;

        $users = User::all();

        if(count($users) >  0){
            if(isset($request->type) && $request->type == 'Pro'){
                $user -> name = $request -> name;
                $user -> email = $request -> email;
                $user -> phone = $request -> phone;
                $user -> type = 'Pro';
                $user -> password = Hash::make($request -> password);
                
                $image = $request->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $fullname = $name.'.webp';
                    $path = 'public/images/users/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(500,500);
                    $resize_image->save('public/images/users/'.$fullname);
                    $user->image = $url;
                }
            }
            else{
                $user -> name = $request -> name;
                $user -> email = $request -> email;
                $user -> type = 'User';
                $user -> password = Hash::make($request -> password);

                $image = $request->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $fullname = $name.'.webp';
                    $path = 'public/images/users/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(500,500);
                    $resize_image->save('public/images/users/'.$fullname);
                    $user->image = $url;
                }
            }
        }
        else{
            $user -> name = $request -> name;
            $user -> email = $request -> email;
            $user -> type = 'Admin';
            $user -> password = Hash::make($request -> password);

            $image = $request->file('image');
            if($image){
                $name = hexdec(uniqid());
                $fullname = $name.'.webp';
                $path = 'public/images/users/';
                $url = $path.$fullname;
                $resize_image=Image::make($image->getRealPath());
                $resize_image->resize(500,500);
                $resize_image->save('public/images/users/'.$fullname);
                $user->image = $url;
            }
        }

        $user->save();

        Auth::login($user);

        if(Route::has('verification.notice')){
            $user->sendEmailVerificationNotification();
        }

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
}
