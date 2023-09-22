<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_index()
    {
        return view('admin.home');
    }

    public function user_index()
    {
        return view('user.home');
    }

    public function pro_index()
    {
        return view('pro.home');
    }
}
