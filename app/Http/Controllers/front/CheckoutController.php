<?php

namespace App\Http\Controllers\front;
use App\Http\Requests\OrderRequest;
use App\Models\Product;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jambasangsang\Flash\Facades\LaravelFlash;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CheckoutController extends Controller
{
    public function check(){
    $oldcartitem=Cart::where('user_id',Auth::id())->get();
    foreach ($oldcartitem as $item){
        if (!Product::where('id',$item->product_id)->where('quantity','>=',$item->quantity)->exists())
        {
            $removeitem=Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
            $removeitem->delete();
        }
    }
     $cartitems=Cart::where('user_id',Auth::id())->get();
        return view('front.check',compact('cartitems'));
    }
    public function checkout( OrderRequest $request){

     $orders=new Order();
        $orders->fname=$request->input('fname');
        $orders->lname=$request->input('lname');
        $orders->email=$request->input('email');
        $orders->phone=$request->input('phone');
        $orders->address=$request->input('address');
        $orders->address2=$request->input('address2');
        $orders->city=$request->input('city');
        $orders->country=$request->input('country');
        $orders->pincode=$request->input('pincode');
        $orders->payment_mode=$request->input('payment-method');
        $orders->payment_id=$request->input('payment_id');
        $orders->user_id=Auth::id();
        $total=0;
        $cartitems=Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems as $item){
            $sub = $item->products->price * $item->quantity ;
            $total += $sub;
        }
        $orders->total_price=$total;
        $orders->save();

        $cartitems=Cart::where('user_id',Auth::id())->get() ;
        foreach ($cartitems as $item){
         OrderItem::create([
              'order_id'=>$orders->id,
              'product_id'=>$item->product_id,
              'quantity'=>$item->quantity,
              'price'=>$item->products->price,
             ]);
        }

        if (Auth::user()->address==NULL){
            $user=User::where('id', Auth::id())->first();
            $user->name=$request->input('fname');
            $user->lname=$request->input('lname');
            $user->phone=$request->input('phone');
            $user->address=$request->input('address');
            $user->address2=$request->input('address2');
            $user->city=$request->input('city');
            $user->country=$request->input('country');
            $user->pincode=$request->input('pincode');
            $user->update();
        }

        if ($request->input('payment-method') == "card"){
            $request->validate([
                'cart_no'=> 'required',
                'exp_month'=> 'required',
                'exp_year'=> 'required',
                'cvc'=> 'required']);
            $stripe=Stripe::setApiKey(env('STRIPE_KEY'));
            try {
                $token=$stripe->tokens()->create([
                    'card'=>[
                        'number'=>$request->cart_no,
                        'exp-month'=> $request->exp_month,
                        'exp-year'=> $request->exp_year,
                        'cvc'=> $request->cvc,
                    ]]);

                if (!isset($token['id'])){
                    session()->flash('alert','stripe token error');
                    return redirect()->route('index')->with(['alert' => 'stripe token error']);
                }
                $customer=$stripe->customer()->create([
                   'name'=>$request->input('fname').''.$request->input('lname'),
                    'email'=>$request->input('email'),
                    'phone'=>$request->input('phone'),
                    'address'=>[
                        'address'=>$request->input('address'),
                        'address2'=>$request->input('address2'),
                        'city'=> $request->input('city'),
                        'country'=>$request->input('country'),
                    ],
                    'shopping'=>[
                        'name'=>$request->input('fname').''.$request->input('lname'),
                        'address'=>[
                            'address'=>$request->input('address'),
                            'address2'=>$request->input('address2'),
                            'city'=> $request->input('city'),
                            'country'=>$request->input('country'),
                        ],
                    ],
                    'source'=>$token['id']
                ]);

                $charge=$stripe->charges()->create ([
                    "customer" => $customer['id'],
                    "currency" => "USD",
                    "amount" => session()->get('checkout')['total'],
                    "description" => 'This payment for'.$orders->id,
                ]);
                if ($charge['status']=='succeeded'){
                    return redirect('check')->with('alert','success');
                }else{
                    return redirect('check')->with('alert','error in transaction');
                }

            }catch (\Exception $e){
                session()->flash('alert',$e->getMessage());
            }

        }


        $cartitems=Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);
        return redirect()->route('index')->with(['alert' => 'order placed successfuly']);

    }


    public function paypalprocess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $amount = 100;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "$amount"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('check')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('check')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }


    }
    public function success(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('check')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('check')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }
    public function cancel()
    {
        return redirect()
            ->route('check')
            ->with('error', $response['message'] ?? 'You have cancelled the transaction.');
    }
}
