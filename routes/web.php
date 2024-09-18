<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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

Route::middleware(['www'])->group(function () {
    Route::get('/', function () {
        return redirect(route('login'));
    })->name('welcome');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/pro-register', [RegisterController::class, 'showProRegistrationForm'])->name('pro-register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('verify-email', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('resend-verify-email', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('/redirect-to-welcome', function() {
        Cookie::queue(Cookie::forget(Str::slug(env('APP_NAME'), '_').'_session'));
        if(Cookie::has('remember_me_'.Str::slug(env('APP_NAME')))){
            Cookie::queue(Cookie::forget('remember_me_'.Str::slug(env('APP_NAME'))));
        }
        return redirect(route('welcome'));
    })->name('redirect.welcome');

    Route::get('reset-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('reset-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password-with-token', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('confirm-password', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmPasswordController::class, 'confirm']);

    Route::patch('/auth/facebook-redirect', [SocialiteController::class, 'facebookredirect'])->name('facebook_login');
    Route::get('/auth/facebook-callback', [SocialiteController::class, 'facebookcallback']);

    Route::patch('/auth/github-redirect', [SocialiteController::class, 'githubredirect'])->name('github_login');
    Route::get('/auth/github-callback', [SocialiteController::class, 'githubcallback']);

    Route::patch('/auth/google-redirect', [SocialiteController::class, 'googleredirect'])->name('google_login');
    Route::get('/auth/google-callback', [SocialiteController::class, 'googlecallback']);

    Auth::routes(['verify' => false, 'reset' => false, 'confirm' => false, 'logout' => false]);
});

Route::middleware(['www', 'auth', 'verified'])->group(function () {
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

    Route::patch('/{type_profile}/connect-facebook', [SocialiteController::class, 'facebookredirect'])->name('facebook_connect');
    Route::patch('/{type_profile}/remove-facebook', [SocialiteController::class, 'facebookremove'])->name('facebook_remove');
    
    Route::patch('/{type_profile}/connect-github', [SocialiteController::class, 'githubredirect'])->name('github_connect');
    Route::patch('/{type_profile}/remove-github', [SocialiteController::class, 'githubremove'])->name('github_remove');

    Route::patch('/{type_profile}/connect-google', [SocialiteController::class, 'googleredirect'])->name('google_connect');
    Route::patch('/{type_profile}/remove-google', [SocialiteController::class, 'googleremove'])->name('google_remove');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
