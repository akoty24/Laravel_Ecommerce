<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
class Team_MemberController extends Controller
{
    public function index(){
        $members = Member::all();
        return view('admin.team_member.index',compact('members'));
    }
    public function create(){
        return view('admin.team_member.create');
    }
    public function store(MemberRequest $request){
        $members =new Member();
        if($request->file('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/member'), $image);
            $members['photo'] = $image;
        }

        $members->name=$request->name;
        $members->title=$request->title;
        $members->description=$request->description;
        $members->btn_text = $request->btn_text;
        $members->save();

        return redirect()->back()->with(['success' =>'Member added successfully']);
    }
    public function edit($id){
        $members = Member::selection()->find($id);
        if (!$members)
            return redirect()->route('admin.team_member')->with(['error' => 'this team_member not found']);

        return view('admin.team_member.edit', compact('members'));

    }
    public function update($id,MemberRequest $request){

        $members= Member::find($id);
        if(!$members){
            return redirect()->back()->with(['error' => 'member not found']);
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/member'), $image);
            Storage::delete($members->photo);
        }
        $members->update([
            'photo' => $image,
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'btn_text' => $request->btn_text,
        ]);
        return redirect()->route('admin.team_member')->with(['success' => 'Team_Member Updated Successfuly']);

    }
    public function show($id){
        $members=Member::where('id',$id)->first();
        return view('admin.team_member.show',compact('members'));
    }
    public function delete($id){
        try {
            $members = Member::find($id);
            Storage::delete($members->photo);
            $members->delete();
            return redirect()->route('admin.team_member')->with(['success' => 'team_member deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.team_member')->with(['error' => 'error: try again']);
        }
    }
}
