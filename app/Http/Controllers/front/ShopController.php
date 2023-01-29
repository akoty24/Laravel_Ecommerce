<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request){
        $cat = $request->get('category') ?? null;
        $products = new Product();
        if ($cat){
            $category = Category::where('id' , $cat)->first();
            $products = $products->where('category_id' , (int)$category?->id);
            $categoryName = $category->name;

        }
        $products = $products->orderBy('id', 'DESC')->paginate(6)->withQueryString();
       $popular_products=Product::inRandomOrder()->limit(4)->get();
        $categories=Category::all();
        return view('front.shop')->with([
            'products'=>$products,
            'categories'=>$categories,
            'popular_products'=> $popular_products,
            'categoryName'=>$categoryName?? null,
        ]);
    }

}
