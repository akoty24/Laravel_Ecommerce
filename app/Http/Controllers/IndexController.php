<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
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
            ->orwhere('slug','like','%'.$request->search.'%')
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


    public function index(Request $request){
        $banners=Banner::get();
        $Slider = Slider::get();
         //
        $categories= Category::paginate(6);
        //
        $cat = $request->get('category') ?? null;
        $products = new Product();
        if ($cat){

            $category = Category::where('id' , $cat)->first();
            $products = $products->where('category_id' , $category->id);
        }

        $products = $products->orderBy('id', 'DESC')->paginate(env('LIMIT'))->withQueryString();

            //   $products=Product::orderBy('created_at','DESC')->get()->take(8);
           //   $categories=Category::get()->take(6);
          //  $products = Product::where('category_id',2)->get();
         // $productss = Product::where('category_id',$categories)->get();

        return view('index',['Slider'=>$Slider,'categories'=>$categories ,'products'=>$products,'banners'=>$banners
        ]);
    }
    public function Profile(){
        return view('admin.user.profile');
    }
    public function myorder(){
        $orders = Order::where('user_id',Auth::id())->where('status',1)->get();
        return view('front.order',compact('orders'));
    }
    public function showorderdetails($id){
        $orders = Order::where('id',$id)->first();
        return view('front.order_show', compact('orders'));
    }
    public function detail_product($id){
        $products= Product::find($id);
        $reviews=Review::where('product_id',$products->id)->get();
        $popular_products=Product::inRandomOrder()->limit(5)->get();
        $related_products=Product::where('category_id',$products->category_id)->inRandomOrder()->limit(10)->get();
        return view('front.product_details',compact('products','related_products','popular_products','reviews'));
    }
    public function privacy_policy(){
        return "privacy-policy";
    }
    public function terms_conditions(){
        return "terms_conditions";
    }
    public  function return_policy(){
        return "return-policy";
    }
    public function home(){
        return view('front.home');
}

    public function AdminDashboard(){
        $users= User::all();
        return view('admin.dashboard',compact('users'));
    }



}
