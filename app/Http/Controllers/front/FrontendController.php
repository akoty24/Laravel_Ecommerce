<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Mail\VisitorContact;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Member;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{

    public function index(Request $request){
        $banners=Banner::get();
        $Slider = Slider::get();
        //
        $cat = $request->get('category') ?? null;
        $products = new Product();
        if ($cat){

            $category = Category::where('id' , $cat)->first();
            $products = $products->where('category_id' , (int)$category?->id);
        }
        $products = $products->inRandomOrder()->paginate(6)->withQueryString();
        $categories= Category::paginate(6);
      //  $products = $products->orderBy('id', 'DESC')->paginate(env('LIMIT'))->withQueryString();

        return view('index',['Slider'=>$Slider,'categories'=>$categories ,'products'=>$products,'banners'=>$banners
        ]);
    }
    public function search(Request $request){

        $popular_products=Product::inRandomOrder()->limit(4)->get();
        $categories=Category::all();

        $cat = $request->get('category') ?? null;
        $products = new Product();
        if ($cat){
            $category = Category::where('id' , $cat)->first();
            $products = $products->where('category_id' , (int)$category?->id);
            $categoryName = $category->name;
        }

        $products=$products->where('name','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('longdescription','like','%'.$request->search.'%')
            ->orwhere('price','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate('6');
        return view('front.shop')->with([
            'products'=>$products,
            'categories'=>$categories,
            'popular_products'=> $popular_products,
            'categoryName'=>$categoryName?? null,
        ]);
        // return view('front.search');
    }
    public function shop(Request $request){
        $cat = $request->get('category') ?? null;
        $products = new Product();
        if ($cat){
            $category = Category::where('id' , $cat)->first();
            $products = $products->where('category_id' , (int)$category?->id);
            $categoryName = $category->name;

        }
        $products = $products->inRandomOrder()->paginate(6)->withQueryString();
        $popular_products=Product::inRandomOrder()->limit(5)->get();
        $categories=Category::all();
        return view('front.shop')->with([
            'products'=>$products,
            'categories'=>$categories,
            'popular_products'=> $popular_products,
            'categoryName'=>$categoryName?? null,
        ]);
    }
    public function product_detail($id){
        $products= Product::find($id);
        $reviews=Review::where('product_id',$products->id)->get();
        $popular_products=Product::inRandomOrder()->limit(5)->get();
        $related_products=Product::where('category_id',$products->category_id)->inRandomOrder()->limit(10)->get();
        return view('front.product_details',compact('products','related_products','popular_products','reviews'));
    }

    public function user_orders(){
        $orders = Order::where('user_id',Auth::id())->where('status',1)->get();
        return view('front.order',compact('orders'));
    }
    public function show_order_details($id){
        $orders = Order::where('id',$id)->first();
        return view('front.order_show', compact('orders'));
    }
    public function update_order_status($id){
        try {
            $orders = Order::find($id);
            if (!$orders)
                return redirect()->route('user.order')->with(['error' => 'order not found ']);
            $status =  $orders -> status  == 1 ? 0 : 1;
            $orders -> update(['status' =>$status ]);
            return redirect()->route('user.order')->with(['success' => ' order cancel successfully ']);

        } catch (\Exception $ex) {
            return redirect()->route('user.order')->with(['error' => 'error try again']);
        }

    }

    public function submit_review(Request $request){
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
    public function add_review($id){
        $order_item=OrderItem::find($id);
        return view('front.userreview',compact('order_item'));
    }

    public function about_us(){
    $team_members=Member::all();
    return view('front.about-us',compact('team_members'));
}
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
