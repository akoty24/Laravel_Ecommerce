<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller

{
    protected function Register(RegisterRequest $request)
    {
        $data = User::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
    ]);

        auth()->login($data);
        return view('index')->with('success','sign up success');;
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

}
