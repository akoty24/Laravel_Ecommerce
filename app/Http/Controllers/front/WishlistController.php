<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add_to_wishlist(Request $request ,$id){
        if (Auth::id()){
            $user=Auth()->user();
            $product=Product::find($id);
            if(WishList::where('product_id',$product->id)->where('user_id',$user->id)->exists()){
                return redirect()->back()->with('message','item  already exist in the WishList');
            }
            else{
                $wishList=new WishList();
                $wishList->user_id=$user->id;
                $wishList->product_id=$product->id;
                $wishList->save();}
            return redirect()->back()->with('success',' item added successfully');
        }
        else{
            return redirect('/login')->with('message','You do not have any permission to access this page');
        }
    }
    public function show_wishlist(){
        $wishlistitems=WishList::where('user_id',Auth::id())->get();
        return view('front.wishlist',compact('wishlistitems'));
    }
    public function remove_from_wishlist( Request $request,$id){
        $wishlist = WishList::where('product_id',$id)->first();
        $wishlist->delete();
        return redirect()->back()->with('success', ' item deleted successfully');
    }

}
