<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
{
    public function admin_profile()
    {
        return view('admin.profile');
    }

    public function admin_edit_email()
    {
        return view('admin.profile.change_email');
    }
    public function admin_edit_password(){
        return view('admin.profile.change_password');
    }
    public function admin_edit_picture(){
        return view('admin.profile.change_picture');
    }

    public function user_profile()
    {
        return view('user.profile');
    }

    public function user_edit_email()
    {
        return view('user.profile.change_email');
    }
    public function user_edit_password(){
        return view('user.profile.change_password');
    }
    public function user_edit_picture(){
        return view('user.profile.change_picture');
    }

    public function pro_profile()
    {
        return view('pro.profile');
    }

    public function pro_edit_email(){
        return view('pro.profile.change_email');
    }
    public function pro_edit_password(){
        return view('pro.profile.change_password');
    }
    public function pro_edit_picture(){
        return view('pro.profile.change_picture');
    }

    public function update_email(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::findorfail(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->email = $request->email;
            $user->save();
            if($user->type == 'Admin'){
                return redirect()->route('admin.profile')->with('message','Email successfully changed');
            }
            else if($user->type == 'User'){
                return redirect()->route('user.profile')->with('message','Email successfully changed');
            }
            else if($user->type == 'Pro'){
                return redirect()->route('pro.profile')->with('message','Email successfully changed');
            }
        }
        else{
            if($user->type == 'Admin'){
                return redirect()->route('admin.edit.email')->with('error','Current password does not match');
            }
            else if($user->type == 'User'){
                return redirect()->route('user.edit.email')->with('error','Current password does not match');
            }
            else if($user->type == 'Pro'){
                return redirect()->route('pro.edit.email')->with('error','Current password does not match');
            }
        }
    }
    public function update_password(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findorfail(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            if($user->type == 'Admin'){
                return redirect()->route('admin.profile')->with('message','Password successfully changed');
            }
            else if($user->type == 'User'){
                return redirect()->route('user.profile')->with('message','Password successfully changed');
            }
            else if($user->type == 'Pro'){
                return redirect()->route('pro.profile')->with('message','Password successfully changed');
            }
        }
        else{
            if($user->type == 'Admin'){
                return redirect()->route('admin.edit.password')->with('error','Current password does not match');
            }
            else if($user->type == 'User'){
                return redirect()->route('user.edit.password')->with('error','Current password does not match');
            }
            else if($user->type == 'Pro'){
                return redirect()->route('pro.edit.password')->with('error','Current password does not match');
            }
        }
    }
    public function update_picture(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image'],
        ]);

        $user = User::findorfail(Auth::user()->id);
        $image = request()->file('image');
        if($image){
            if($user->image != 'images/users/default.webp'){
                if(file_exists($user->image)){
                    unlink($user->image);
                }
            }
            $name = hexdec(uniqid());
            $fullname = $name.'.webp';
            $path = 'images/users/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(500,500);
            $resize_image->save('images/users/'.$fullname);
            $user->image = $url;
            $user->save();
            if($user->type == 'Admin'){
                return redirect()->route('admin.profile')->with('message','Profile Picture successfully changed');
            }
            else if($user->type == 'User'){
                return redirect()->route('user.profile')->with('message','Profile Picture successfully changed');
            }
            else if($user->type == 'Pro'){
                return redirect()->route('pro.profile')->with('message','Profile Picture successfully changed');
            }
        }
    }
}
