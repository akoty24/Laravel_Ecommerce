<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request){
     if ($request->max_price && $request->min_price) {
            $max = $request->max_price;
            $min = $request->min_price;
            if ($max >= $min) {
                $Products = Product::whereBetween('price', [$min, $max])->get();
            } else {
                $Products = Product::latest()->get();
            }
        }
        else {
            $Products = Product::latest()->get();
        }
        return view('admin.product.index', compact('Products'));
    }
    public function create(){
        return view('admin.product.create');
    }
    public function store(ProductRequest $request){

        $Products =new Product();
        if($request->file('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/product'), $image);
            $Products['photo'] = $image;
        }
        $Products->name=$request->name;
        $Products->price=$request->price;
        $Products->quantity=$request->quantity;
        $Products->description=$request->description;
        $Products->longdescription=$request->longdescription;
        $Products->category_id=$request->Category_id;
        $Products->active=$request->active;
        $Products->save();
        return redirect()->back()->with(['success' =>'added successfuly']);

    }
    public function edit($id){
        $Products = Product::selection()->find($id);
        if (!$Products)
            return redirect()->route('admin.product')->with(['error' => 'this product no found']);

        return view('admin.product.edit', compact('Products'));

    }
    public function update($id,ProductRequest $request){
        $Products= Product::find($id);
        if(!$Products){
            return redirect()->back()->with(['error' => 'Product not found']);
        }

        if ($request->hasFile('photo')) {
            $path = 'front/photos/product/'.$Products->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/product/'), $filename);
            $Products->photo = $filename;
        }
        $Products->name = $request->name;
        $Products->active = $request->active;
        $Products->Category_id = $request->Category_id;
        $Products->price = $request->price;
        $Products->quantity = $request->quantity;
        $Products->description = $request->description;
        $Products->longdescription = $request->longdescription;
        $Products->update();
        return redirect()->route('admin.product')->with(['success' => 'Product updated successfuly']);

    }
    public function show($id){
        $Product=Product::where('id',$id)->first();
        return view('admin.product.show',compact('Product'));
    }
    public function delete($id){
        try {
            $Products = Product::find($id);
            Storage::delete($Products->photo);
            $Products->delete();
            return redirect()->route('admin.product')->with(['success' => 'product deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.product')->with(['error' => 'error: try again']);
        }
    }
    public function status($id){
        try {
            $Products = Product::find($id);
            if (!$Products)
                return redirect()->route('admin.product')->with(['error' => 'user no found']);

            $status =  $Products -> active  == 0 ? 1 : 0;

            $Products -> update(['active' =>$status ]);

            return redirect()->route('admin.product')->with(['success' => 'status changed successfully ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.product')->with(['error' => 'error try again']);
        }
    }


}
