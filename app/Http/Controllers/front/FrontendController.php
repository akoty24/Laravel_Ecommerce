<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
public function about(){
    $team_members=Member::all();
    return view('front.about-us',compact('team_members'));
}
}
