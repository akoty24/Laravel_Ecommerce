<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{


   public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            if($request->user()->role=='ADM'){
                return $next($request);
            }else{
               return redirect('/login')->with('success','You do not have any permission to access this page');
            }
        } else {
            return redirect('/login')->with('success','login to access the website info');
        }
        return $next($request);
    }
}