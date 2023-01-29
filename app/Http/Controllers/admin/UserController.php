<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(UserRequest $request){
        $users =new User();
        if($request->file('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/user'), $image);
            $users['photo'] = $image;
        }

        $users->name=$request->name;
        $users->lname=$request->lname;
        $users->email=$request->email;
        $users->password=bcrypt($request->password);
        $users->phone=$request->phone;
        $users->active=$request->active;
        $users->address=$request->address;
        $users->address2=$request->address2;
        $users->city=$request->city;
        $users->country=$request->country;
        $users->pincode=$request->pincode;
        $users->role=$request->role;
        $users->save();
        return redirect()->back()->with(['success' =>'User added successfully']);
    }
    public function edit($id){
        $Users = User::selection()->find($id);
        if (!$Users)
            return redirect()->route('admin.user')->with(['error' => 'this user no found']);

        return view('admin.user.edit', compact('Users'));

    }
    public function update($id,UserRequest $request){

        $Users= User::find($id);
        if(!$Users){
            return redirect()->back()->with(['error' => 'user not found']);
        }
        if ($request->hasFile('photo')) {
            $path = 'front/photos/user/'.$Users->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/user/'), $filename);
            $Users->photo = $filename;
        }

        $Users->name = $request->name;
        $Users->lname = $request->lname;
        $Users->email = $request->email;
        $Users->password=bcrypt($request->password);
        $Users->phone = $request->phone;
        $Users->address = $request->address;
        $Users->address2 = $request->address2;
        $Users->city = $request->city;
        $Users->country = $request->country;
        $Users->pincode = $request->pincode;
        $Users->active = $request->active;
        $Users->role = $request->role;
        $Users->update();
        return redirect()->route('admin.user')->with(['success' => ' User updated successfuly']);

    }
    public function show($id){
        $user=User::where('id',$id)->first();
        return view('admin.user.show',compact('user'));
    }
    public function delete($id){
        try {
            $Users = User::find($id);
            Storage::delete($Users->photo);
            $Users->delete();
            return redirect()->route('admin.user')->with(['success' => 'deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.user')->with(['error' => 'error: try again']);
        }
    }
    public function status($id){
        try {
            $Users = User::find($id);
            if (!$Users)
                return redirect()->route('admin.user')->with(['error' => 'user no found']);

            $status =  $Users -> active  == 0 ? 1 : 0;

            $Users -> update(['active' =>$status ]);

            return redirect()->route('admin.user')->with(['success' => 'status changed successfully ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.user')->with(['error' => 'error try again']);
        }
    }
}
