<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{
public function profile(){
   // $profile=Profile::with('user')->get();
    $user=User::find(Auth::user()->id);
    return view('admin.user.profile',compact('user'));
}
public function editprofile($id){
    $user=User::find($id);
return view('admin.user.editprofile',compact('user'));
}
public function updateprofile($id,Request $request){

    $user= User::find($id);
    if(!$user){
        return redirect()->back()->with(['error' => 'profile not found']);
    }
    if($request->file('photo')) {
        $file = $request->file('photo');
        $image = date('photo') . $file->getClientOriginalName();
        $file->move(public_path('front/photos/user'), $image);
        $user['photo'] = $image;
    }
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');

        $user->save();
        return redirect()->route('profile')->with(['alert' => 'updated successfully']);


}
}
