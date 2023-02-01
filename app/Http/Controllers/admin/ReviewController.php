<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReviewController extends Controller
{
    public function index(Request $request){
        $reviews = Review::all();

        if ($request->start_date && $request->end_date ) {

            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);

            if ($end_date->greaterThan($start_date)) {
                $reviews = Review::whereBetween('created_at', [$start_date, $end_date])->get();
            } else {
                $reviews = Review::latest()->get();
            }
        }
        else {
            $reviews = Review::latest()->get();
        }
        return view('admin.review.index', compact('reviews'));
    }
    public function show($id){
        $review=Review::where('id',$id)->first();
        return view('admin.review.show',compact('review'));
    }
    public function delete($id){
        try {
            $Reviews = Review::find($id);
            $Reviews->delete();
            return redirect()->route('admin.review')->with(['success' => 'review deleted successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.review')->with(['error' => 'error: try again']);
        }
    }
}
