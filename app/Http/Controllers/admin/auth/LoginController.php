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
    public function getLogin(){
        return view('admin.auth.login');
    }


public  function Login(LoginRequest $request) {
    if (auth()->attempt(['email' => $request->email,'password' => $request->password])) {
        return redirect()->route('index');

    }
    else{
        return redirect()->back()->with('fail','email or passwor error');

    }
    }



}
