<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
public function index(){
    $reviews = Review::all();
    return view('admin.review.index', compact('reviews'));
}

    /**
     * @throws ValidationException
     */
    public function storereview(Request $request){
        $this->validateWith([
            'rating' => 'required',
            'comment' => 'required',
            ]);
        $reviews=new Review();
        $reviews->rating=$request->input('rating');
        $reviews->comment=$request->input('comment');
        $reviews->product_id=$request->input('product_id');
        $reviews->user_id=Auth::user()->id ;
        $reviews->order_item_id=$request->input('order_item_id');
        $reviews->save();
        return redirect()->back()->with(['alert' =>'your review has been added successfully']);

    }
    public function addreview($id){
        $order_item=OrderItem::find($id);
        return view('front.userreview',compact('order_item'));
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
