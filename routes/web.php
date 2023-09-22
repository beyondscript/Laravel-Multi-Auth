<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
})->name('welcome');

Route::get('/redirect-to-welcome', function() {
    Cookie::queue(Cookie::forget(Str::slug(env('APP_NAME'), '_').'_session'));
    if(Cookie::has('remember_me_'.Str::slug(env('APP_NAME')))){
        Cookie::queue(Cookie::forget('remember_me_'.Str::slug(env('APP_NAME'))));
    }
    return redirect(route('welcome'));
})->name('redirect.welcome');

Route::get('pro-register', [RegisterController::class, 'showProRegistrationForm'])->name('pro-register');
Route::post('/user-login', [LoginController::class, 'customlogin'])->name('custom_login');
Route::post('/user-register', [RegisterController::class, 'customregister'])->name('custom_register');

Route::patch('/auth/facebook/redirect', [SocialiteController::class, 'facebookredirect'])->name('facebook_login');
Route::get('/auth/facebook/callback', [SocialiteController::class, 'facebookcallback']);

Route::patch('/auth/github/redirect', [SocialiteController::class, 'githubredirect'])->name('github_login');
Route::get('/auth/github/callback', [SocialiteController::class, 'githubcallback']);

Route::patch('/auth/google/redirect', [SocialiteController::class, 'googleredirect'])->name('google_login');
Route::get('/auth/google/callback', [SocialiteController::class, 'googlecallback']);

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-home', [HomeController::class, 'admin_index'])->name('admin.home');
        Route::get('/admin-profile', [ProfileController::class, 'admin_profile'])->name('admin.profile');

        Route::get('/admin-profile/edit-email', [ProfileController::class, 'admin_edit_email'])->name('admin.edit.email');
        Route::get('/admin-profile/edit-password', [ProfileController::class, 'admin_edit_password'])->name('admin.edit.password');
        Route::get('/admin-profile/edit-profile-picture', [ProfileController::class, 'admin_edit_picture'])->name('admin.edit.picture');
    });
    Route::middleware(['user'])->group(function () {
        Route::get('/user-home', [HomeController::class, 'user_index'])->name('user.home');
        Route::get('/user-profile', [ProfileController::class, 'user_profile'])->name('user.profile');

        Route::get('/user-profile/edit-email', [ProfileController::class, 'user_edit_email'])->name('user.edit.email');
        Route::get('/user-profile/edit-password', [ProfileController::class, 'user_edit_password'])->name('user.edit.password');
        Route::get('/user-profile/edit-profile-picture', [ProfileController::class, 'user_edit_picture'])->name('user.edit.picture');
    });
    Route::middleware(['pro'])->group(function () {
        Route::get('/pro-home', [HomeController::class, 'pro_index'])->name('pro.home');
        Route::get('/pro-profile', [ProfileController::class, 'pro_profile'])->name('pro.profile');

        Route::get('/pro-profile/edit-email', [ProfileController::class, 'pro_edit_email'])->name('pro.edit.email');
        Route::get('/pro-profile/edit-password', [ProfileController::class, 'pro_edit_password'])->name('pro.edit.password');
        Route::get('/pro-profile/edit-profile-picture', [ProfileController::class, 'pro_edit_picture'])->name('pro.edit.picture');
    });

    Route::patch('/{type_profile}/update-email', [ProfileController::class, 'update_email'])->name('update.email');
    Route::patch('/{type_profile}/update-password', [ProfileController::class, 'update_password'])->name('update.password');
    Route::patch('/{type_profile}/update-picture', [ProfileController::class, 'update_picture'])->name('update.picture');

    Route::patch('/{type_profile}/facebook/connect', [SocialiteController::class, 'facebookredirect'])->name('facebook_connect');
    Route::patch('/{type_profile}/facebook/remove', [SocialiteController::class, 'facebookremove'])->name('facebook_remove');
    
    Route::patch('/{type_profile}/github/connect', [SocialiteController::class, 'githubredirect'])->name('github_connect');
    Route::patch('/{type_profile}/github/remove', [SocialiteController::class, 'githubremove'])->name('github_remove');

    Route::patch('/{type_profile}/google/connect', [SocialiteController::class, 'googleredirect'])->name('google_connect');
    Route::patch('/{type_profile}/google/remove', [SocialiteController::class, 'googleremove'])->name('google_remove');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('custom_logout');
});
