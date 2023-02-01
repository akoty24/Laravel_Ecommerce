<?php

namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function add_to_cart( Request $request ,$id)
{  if (Auth::id()) {
    $product = Product::where('id', $id)->first();

    if (!$product) {
        return redirect()->route('home');
    }
    $user_id = auth()->user()->id;
    $cart = Cart::where(['product_id' => $id, 'user_id' => $user_id])->first();
    if ($cart) {
        $cart->quantity += 1;
        $cart->save();
    } else {
        $data = [
            'quantity' => (int)$request->get('quantity') ?? 1,
            'product_id' => $id,
            'user_id' => $user_id
        ];
        Cart::create($data);
    }
    return redirect()->back()->with('alert', ' item added successfully');
}else{
    return redirect('/login')->with('errorAlert','You do not have any permission to access this page');
}
}
    public function show_cart(){
    $cartitems=Cart::where('user_id',Auth::id())->get();
  //  $cartitems = auth()->user()->cart;
    return view('front.cart',compact('cartitems'));
}
    public function remove_from_cart($id){

    $cart = Cart::where('product_id',$id)->first();
    $cart->delete();
    return redirect()->back()->with('success', ' item deleted successfully');
}
    public function updateProduct(Request $request)
    {
        $prod_id = $request->prod_id;
        $prod_qty = $request->product_qty;

        if (Auth::check()) {
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart_item = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart_item->quantity = $prod_qty;
                $cart_item->update();
                return response()->json(['status' => 'Product Quantity Updated Successfully!']);
            }
        } else {
            return response()->json(['status' => 'Login To Continue']);
        }
    }
    public function cartCount()
    {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cart_count]);
    }

}
