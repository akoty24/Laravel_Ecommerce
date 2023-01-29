<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function add(){
        return view('admin.message.add');
    }
    public function index(){
        $messages = Message::all();
        return view('admin.message.index', compact('messages'));
    }
    public function show($id){
        $messages=Message::where('id',$id)->first();
        return view('admin.message.show',compact('messages'));
    }
    public function delete($id){
        try {
            $messages = Message::find($id);
            $messages->delete();
            return redirect()->route('admin.message')->with(['success' => 'Message deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.message')->with(['error' => 'error: try again']);
        }
    }
}
