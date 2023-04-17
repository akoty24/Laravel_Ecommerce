<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function Login_and_register_page(){
        return view('admin.auth.login');
    }


public  function Login(LoginRequest $request) {
    if (auth()->attempt(['email' => $request->email,'password' => $request->password,'role'=>'USR'])) {
        return redirect()->route('index')->with('success','login success');
    }elseif (auth()->attempt(['email' => $request->email,'password' => $request->password,'role'=>'ADM'])) {
        return redirect()->route('admin.dashboard')->with('success','login success');
    }
    else{
        return redirect()->back()->with('message','email or password error');
    }

    }
}
