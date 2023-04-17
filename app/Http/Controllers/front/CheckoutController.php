<?php

namespace App\Http\Controllers\front;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jambasangsang\Flash\Facades\LaravelFlash;
use Session;
use Stripe;



class CheckoutController extends Controller
{
    public function checkout()
    {
        $oldcartitem = Cart::where('user_id', Auth::id())->get();
        foreach ($oldcartitem as $item) {
            if (!Product::where('id', $item->product_id)->where('quantity', '>=', $item->quantity)->exists()) {
                $removeitem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
                $removeitem->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('front.checkout', compact('cartitems',));
    }

    public function place_order(Request $request)
    {
        $request->validate([
    'fname' => 'required',
    'lname' => 'required|',
    'email'=>'required|email',
    'phone'=>'required',
    'address'=>'required',
    'city'=>'required',
    'country'=>'required',
    'pincode'=>'required',
    'payment-method'=>'required',
   // 'payment_id'=>'required',
]);
        $orders = new Order();
        $orders->fname = $request->input('fname');
        $orders->lname = $request->input('lname');
        $orders->email = $request->input('email');
        $orders->phone = $request->input('phone');
        $orders->address = $request->input('address');
        $orders->address2 = $request->input('address2');
        $orders->city = $request->input('city');
        $orders->country = $request->input('country');
        $orders->pincode = $request->input('pincode');
        $orders->payment_mode =$request->input('payment-method');
     //   $orders->payment_id = $request->input('payment_id');
        $orders->user_id = Auth::user()->id;
        $total = 0;
        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            $sub = $item->products->price * $item->quantity;
            $total += $sub;
        }
        $orders->total_price = $total;
        $orders->save();

        foreach ($cartitems as $item) {
            OrderItem::create([
                'order_id' => $orders->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->products->price,
            ]);
        }
        if (Auth::user()->address == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->address = $request->input('address');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        if ($request->input('payment-method') == "card"){
            return redirect()->route('payment.form');
        }
        elseif($request->input('payment-method') == "Cash On Delivery"){
            $cartitems=Cart::where('user_id',Auth::id())->get();
            Cart::destroy($cartitems);
            return redirect()->route('index')->with(['success' => 'order placed successfuly']);
        }

        else{
            return redirect()->back()->with(['success' => 'order error']);

        }
    }


    public function payment_form(){

        $oldcartitem = Cart::where('user_id', Auth::id())->get();
        foreach ($oldcartitem as $item) {
            if (!Product::where('id', $item->product_id)->where('quantity', '>=', $item->quantity)->exists()) {
                $removeitem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
                $removeitem->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('front.payment_form', compact('cartitems',));
    }

    public function stripePost( Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        return redirect()->route('index')->with(['success' => 'payment placed successfuly']);
    }


}


//public function place_order( OrderRequest $request){
//
//    $orders=new Order();
//    $orders->fname=$request->input('fname');
//    $orders->lname=$request->input('lname');
//    $orders->email=$request->input('email');
//    $orders->phone=$request->input('phone');
//    $orders->address=$request->input('address');
//    $orders->address2=$request->input('address2');
//    $orders->city=$request->input('city');
//    $orders->country=$request->input('country');
//    $orders->pincode=$request->input('pincode');
//    $orders->payment_mode=$request->input('payment-method');
//    $orders->payment_id=$request->input('payment_id');
//    $orders->user_id=Auth::id();
//    $total=0;
//    $cartitems=Cart::where('user_id',Auth::id())->get();
//    foreach ($cartitems as $item){
//        $sub = $item->products->price * $item->quantity ;
//        $total += $sub;
//    }
//    $orders->total_price=$total;
//    $orders->save();
//
//    $cartitems=Cart::where('user_id',Auth::id())->get() ;
//    foreach ($cartitems as $item){
//        OrderItem::create([
//            'order_id'=>$orders->id,
//            'product_id'=>$item->product_id,
//            'quantity'=>$item->quantity,
//            'price'=>$item->products->price,
//        ]);
//    }
//
//    if (Auth::user()->address==NULL){
//        $user=User::where('id', Auth::id())->first();
//        $user->name=$request->input('fname');
//        $user->lname=$request->input('lname');
//        $user->phone=$request->input('phone');
//        $user->address=$request->input('address');
//        $user->address2=$request->input('address2');
//        $user->city=$request->input('city');
//        $user->country=$request->input('country');
//        $user->pincode=$request->input('pincode');
//        $user->update();
//    }
//
//    if ($request->input('payment-method') == "card"){
//        $request->validate([
//            'cart_no'=> 'required|numeric',
//            'exp_month'=> 'required|numeric',
//            'exp_year'=> 'required|numeric',
//            'cvc'=> 'required|numeric']);
//
//        $stripe=Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
//        try {
//            $token=$stripe->tokens()->create([
//                'card'=>[
//                    'number'=>$request->cart_no,
//                    'exp-month'=> $request->exp_month,
//                    'exp-year'=> $request->exp_year,
//                    'cvc'=> $request->cvc,
//                ]]);
//
//            if (!isset($token['id'])){
//                session()->flash('alert','stripe token error');
//                return redirect()->route('index')->with(['alert' => 'stripe token error']);
//            }
//            $customer=$stripe->customer()->create([
//                'name'=>$request->input('fname').''.$request->input('lname'),
//                'email'=>$request->input('email'),
//                'phone'=>$request->input('phone'),
//                'address'=>[
//                    'address'=>$request->input('address'),
//                    'address2'=>$request->input('address2'),
//                    'city'=> $request->input('city'),
//                    'country'=>$request->input('country'),
//                ],
//                'shopping'=>[
//                    'name'=>$request->input('fname').''.$request->input('lname'),
//                    'address'=>[
//                        'address'=>$request->input('address'),
//                        'address2'=>$request->input('address2'),
//                        'city'=> $request->input('city'),
//                        'country'=>$request->input('country'),
//                    ],
//                ],
//                'source'=>$token['id']
//            ]);
//
//            $charge=$stripe->charges()->create ([
//                "customer" => $customer['id'],
//                "currency" => "USD",
//                "amount" => session()->get('checkout')['total'],
//                "description" => 'This payment for'.$orders->id,
//            ]);
//            if ($charge['status']=='succeeded'){
//                return redirect('check')->with('alert','success');
//            }else{
//                return redirect('check')->with('alert','error in transaction');
//            }
//
//        }catch (\Exception $e){
//            session()->flash('alert',$e->getMessage());
//        }
//
//    }
//
//    $cartitems=Cart::where('user_id',Auth::id())->get();
//    Cart::destroy($cartitems);
//    return redirect()->route('index')->with(['success' => 'order placed successfuly']);
//
//}











//if ($request->input('payment-method') == "card"){
//    $request->validate([
//        'cart_no'=> 'required|numeric',
//        'exp_month'=> 'required|numeric',
//        'exp_year'=> 'required|numeric',
//        'cvc'=> 'required|numeric']);
//
//    $charge=Stripe::charges()->create([
//        'currency'=>'USD',
//        'amount'=>$total,
//        'source'=>'tok_amex',
//        'description'=>"This payment for'.$orders->id",
//
//    ]);
//    $chargeId=$charge['id'];
//    if ($chargeId){
//        $cartitems=Cart::where('user_id',Auth::id())->get();
//        Cart::destroy($cartitems);
//        return redirect()->route('index')->with(['success' => 'order placed successfuly']);
//    }else{
//        return redirect()->back()->with(['success' => 'order error']);
//    }
//}
//elseif($request->input('payment-method') == "Cash On Delivery"){
//    $cartitems=Cart::where('user_id',Auth::id())->get();
//    Cart::destroy($cartitems);
//    return redirect()->route('index')->with(['success' => 'order placed successfuly']);
//}
//
//else{
//    return redirect()->back()->with(['success' => 'order error']);
//
//}
