<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class  CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(CategoryRequest $request){
        $categories =new Category();
        if($request->file('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/category'), $image);
            $categories['photo'] = $image;
        }

            $categories->name=$request->name;
            $categories->slug=$request->slug;
            $categories->active=$request->active;
            $categories->save();
            return redirect()->back()->with(['success' =>'Category added successfully']);
        /*

        if (!$request->has('photo')) {
            return response()->json(['message' => 'Missing file'], 422);
        }
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('front/photos/category'),$imageName);


        $categories =new Category();
        $categories->name=$request->categoryname;
        $categories->slug=$request->categoryname;
        $categories->photo=$imageName;
        $categories->active=$request->categoryactive;
        $categories->save();
        return redirect()->back()->with(['success' =>'added successfuly']);*/
    }
    public function edit($id){
        $Category = Category::selection()->find($id);

        if (!$Category)
            return redirect()->route('admin.category')->with(['error' => 'this category no found']);

        return view('admin.category.edit', compact('Category'));

    }
    public function update($id,CategoryRequest $request){

        $Category= Category::find($id);
        if(!$Category){
            return redirect()->back()->with(['error' => 'category not found']);
        }

        if ($request->hasFile('photo')) {
            $path = 'front/photos/category/' . $Category->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/category/'), $filename);
            $Category->photo = $filename;
        }
        $Category->name = $request->name;
        $Category->slug = $request->slug;
        $Category->active = $request->active;
        $Category->update();
          return redirect()->route('admin.category')->with(['alert' => 'updated successfuly']);

    }
    public function delete($id){
        try {
            $Category = Category::find($id);
            Storage::delete($Category->photo);
            $Category->delete();
            return redirect()->route('admin.category')->with(['success' => 'deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'error: try again']);
        }
    }
    public function status($id){
        try {
            $Category = Category::find($id);
            if (!$Category)
                return redirect()->route('admin.category')->with(['error' => 'category not found ']);

            $status =  $Category -> active  == 0 ? 1 : 0;

            $Category -> update(['active' =>$status ]);

            return redirect()->route('admin.category')->with(['success' => ' status change successfully ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'error try again']);
        }
    }
}
