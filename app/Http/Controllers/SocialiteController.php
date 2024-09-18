<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialiteController extends Controller
{
    public function facebookredirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback(Request $request){
        if ($request->has('error')) {
            if($request->error == 'access_denied'){
                if (Auth::check()) {
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'));
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'));
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'));
                    }
                }
                else{
                    return redirect(route('login'));
                }
            }
        }
        $facebook_user = Socialite::driver('facebook')->user();
        $user = User::where('facebook_id', $facebook_user->id)->first();
        if($user){
            if (Auth::check()) {
                if(Auth::user()->type == 'Admin'){
                    return redirect(route('admin.profile'))->with('error','Already connected with Facebook');
                }
                else if(Auth::user()->type == 'User'){
                    return redirect(route('user.profile'))->with('error','Already connected with Facebook');
                }
                else if(Auth::user()->type == 'Pro'){
                    return redirect(route('pro.profile'))->with('error','Already connected with Facebook');
                }
            }
            else{
                Auth::login($user);
                if($user->type == 'Admin'){
                    return redirect(route('admin.home'));
                }
                else if($user->type == 'User'){
                    return redirect(route('user.home'));
                }
                else if($user->type == 'Pro'){
                    return redirect(route('pro.home'));
                }
            }
        }
        else{
            if (Auth::check()) {
                $auth_user = Auth::user();
                if($auth_user->facebook_id){
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('error','Already connected with Facebook');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('error','Already connected with Facebook');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('error','Already connected with Facebook');
                    }
                }
                else{
                    $auth_user->facebook_id = $facebook_user->id;
                    $auth_user->save();
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('message','Successfully connected with Facebook');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('message','Successfully connected with Facebook');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('message','Successfully connected with Facebook');
                    }
                }
            }
            else{
                return redirect(route('login'))->with('error','Please connect your account with Facebook');
            }
        }
    }

    public function githubredirect(){
        return Socialite::driver('github')->redirect();
    }

    public function githubcallback(Request $request){
        if ($request->has('error')) {
            if($request->error == 'access_denied'){
                if (Auth::check()) {
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'));
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'));
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'));
                    }
                }
                else{
                    return redirect(route('login'));
                }
            }
        }
        $github_user = Socialite::driver('github')->user();
        $user = User::where('github_id', $github_user->id)->first();
        if($user){
            if (Auth::check()) {
                if(Auth::user()->type == 'Admin'){
                    return redirect(route('admin.profile'))->with('error','Already connected with GitHub');
                }
                else if(Auth::user()->type == 'User'){
                    return redirect(route('user.profile'))->with('error','Already connected with GitHub');
                }
                else if(Auth::user()->type == 'Pro'){
                    return redirect(route('pro.profile'))->with('error','Already connected with GitHub');
                }
            }
            else{
                Auth::login($user);
                if($user->type == 'Admin'){
                    return redirect(route('admin.home'));
                }
                else if($user->type == 'User'){
                    return redirect(route('user.home'));
                }
                else if($user->type == 'Pro'){
                    return redirect(route('pro.home'));
                }
            }
        }
        else{
            if (Auth::check()) {
                $auth_user = Auth::user();
                if($auth_user->github_id){
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('error','Already connected with GitHub');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('error','Already connected with GitHub');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('error','Already connected with GitHub');
                    }
                }
                else{
                    $auth_user->github_id = $github_user->id;
                    $auth_user->save();
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('message','Successfully connected with GitHub');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('message','Successfully connected with GitHub');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('message','Successfully connected with GitHub');
                    }
                }
            }
            else{
                return redirect(route('login'))->with('error','Please connect your account with GitHub');
            }
        }
    }

    public function googleredirect(){
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(Request $request){
        $google_user = Socialite::driver('google')->user();
        $user = User::where('google_id', $google_user->id)->first();
        if($user){
            if (Auth::check()) {
                if(Auth::user()->type == 'Admin'){
                    return redirect(route('admin.profile'))->with('error','Already connected with Google');
                }
                else if(Auth::user()->type == 'User'){
                    return redirect(route('user.profile'))->with('error','Already connected with Google');
                }
                else if(Auth::user()->type == 'Pro'){
                    return redirect(route('pro.profile'))->with('error','Already connected with Google');
                }
            }
            else{
                Auth::login($user);
                if($user->type == 'Admin'){
                    return redirect(route('admin.home'));
                }
                else if($user->type == 'User'){
                    return redirect(route('user.home'));
                }
                else if($user->type == 'Pro'){
                    return redirect(route('pro.home'));
                }
            }
        }
        else{
            if (Auth::check()) {
                $auth_user = Auth::user();
                if($auth_user->google_id){
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('error','Already connected with Google');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('error','Already connected with Google');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('error','Already connected with Google');
                    }
                }
                else{
                    $auth_user->google_id = $google_user->id;
                    $auth_user->save();
                    if(Auth::user()->type == 'Admin'){
                        return redirect(route('admin.profile'))->with('message','Successfully connected with Google');
                    }
                    else if(Auth::user()->type == 'User'){
                        return redirect(route('user.profile'))->with('message','Successfully connected with Google');
                    }
                    else if(Auth::user()->type == 'Pro'){
                        return redirect(route('pro.profile'))->with('message','Successfully connected with Google');
                    }
                }
            }
            else{
                return redirect(route('login'))->with('error','Please connect your account with Google');
            }
        }
    }

    public function facebookremove(){
        $user = Auth::user();
        if($user->facebook_id){
            $user->facebook_id = null;
            $user->save();
            return redirect()->back()->with('error','Successfully removed from Facebook');
        }
        else{
            return redirect()->back()->with('error','Already removed from Facebook');
        }
    }

    public function githubremove(){
        $user = Auth::user();
        if($user->github_id){
            $user->github_id = null;
            $user->save();
            return redirect()->back()->with('error','Successfully removed from GitHub');
        }
        else{
            return redirect()->back()->with('error','Already removed from GitHub');
        }
    }

    public function googleremove(){
        $user = Auth::user();
        if($user->google_id){
            $user->google_id = null;
            $user->save();
            return redirect()->back()->with('error','Successfully removed from Google');
        }
        else{
            return redirect()->back()->with('error','Already removed from Google');
        }
    }
}
