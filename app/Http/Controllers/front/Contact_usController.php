<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Mail\VisitorContact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Contact_usController extends Controller
{
    public function contact_us(){
        return view('front.contact-us');
    }
    public function submit_contact_form(Request $request){
        $validatedData =  $request->validate([
            'fname' => 'required|string|min:3|max:50',
            'lname' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'subject' => 'required',
            'comment' => 'required|string|min:3',
        ]);
//        $data=[
//            'name'=>$request->name,
//            'email'=>$request->email,
//            'phone'=>$request->phone,
//            'comment'=>$request->comment,
//        ];
        Message::create($request->all());
        //  Mail::to('akotysaber24@gmail.com')->send(new VisitorContact($data));
        //  Mail::to('akotysaber24@gmail.com')->send(new VisitorContact($request->all()));
        Mail::to('akotysaber24@gmail.com')->send(new VisitorContact($validatedData));
           return back()->with('alert','your message send successfully,We Will Get Back To You Soon!');
    }
}
