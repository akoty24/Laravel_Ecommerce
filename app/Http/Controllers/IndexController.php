<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function home(){
        return view('front.home');
    }
    public function Admin_Dashboard(){
        $users= User::all();
        return view('admin.dashboard',compact('users'));
    }

    public function profile(){
        // $profile=Profile::with('user')->get();
        $user=User::find(Auth::user()->id);
        return view('admin.user.profile',compact('user'));
    }
    public function edit_profile($id){
        $user=User::find($id);
        return view('admin.user.editprofile',compact('user'));
    }
    public function update_profile($id,Request $request){
        $request->validate([
            'photo'=> 'image|mimes:png,jpg,gif,gpeg',
            'name' => 'required|min:3',
            'lname' => 'required|min:3',
            'phone'=>'required' ,
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pincode' => 'required',
]);
        $user= User::find($id);
        if(!$user){
            return redirect()->back()->with(['message' => 'profile not found']);
        }
        if ($request->hasFile('photo')) {
            $path = 'front/photos/user/'.$user->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/user/'), $filename);
            $user->photo = $filename;
        }
        $user->name=$request->name;
        $user->lname=$request->lname;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->address2=$request->address2;
        $user->country=$request->country;
        $user->city=$request->city;
        $user->pincode=$request->pincode;
        $user->update();
        return redirect()->route('profile')->with(['success' => 'profile updated successfully']);


    }
}
