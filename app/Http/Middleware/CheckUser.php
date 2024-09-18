<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->type == 'User'){
            return $next($request);
        }
        else if(Auth::user()->type == 'Admin'){
            return redirect()->route('admin.home')->with('error','You are not allowed to perform this action');
        }
        else if(Auth::user()->type == 'Pro'){
            return redirect()->route('pro.home')->with('error','You are not allowed to perform this action');
        }
    }
}
