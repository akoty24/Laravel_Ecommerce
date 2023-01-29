<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(){
        $Banners = Banner::all();
        return view('admin.banner.index', compact('Banners'));
    }
    public function create(){
        return view('admin.banner.create');
    }
    public function store(BannerRequest $request){
        $Banners =new Banner();

        if($request->file('photo1')) {
            $file = $request->file('photo1');
            $image1 = date('photo1') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/banner'), $image1);
            $Banners['photo1'] = $image1;
        }
        if($request->file('photo2')) {
            $file = $request->file('photo2');
            $image2 = date('photo2') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/banner'), $image2);
            $Banners['photo2'] = $image2;
        }

        $Banners->title1=$request->title1;
        $Banners->description1=$request->description1;
        $Banners->title2=$request->title2;
        $Banners->description2=$request->description2;
        $Banners->save();
        return redirect()->back()->with(['success' =>' banner added successfully']);

    }
    public function edit($id){
        $Banners = Banner::selection()->find($id);
        if (!$Banners)
            return redirect()->route('admin.banner')->with(['error' => 'this banner no found']);
        return view('admin.banner.edit',compact('Banners'));

    }
    public function update($id,BannerRequest $request){

        $Banners= Banner::find($id);
        if(!$Banners){
            return redirect()->back()->with(['error' => 'banner not found']);
        }
        if ($request->hasFile('photo1')) {
            $path = 'front/photos/banner/' . $Banners->photo1;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo1');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/banner/'), $filename);
            $Banners->photo1 = $filename;
        }
        if ($request->hasFile('photo2')) {
            $path = 'front/photos/banner/' . $Banners->photo2;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo2');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/banner/'), $filename);
            $Banners->photo2 = $filename;
        }
          $Banners->title1= $request->title1;
          $Banners->description1=$request->description1;
          $Banners->title2 = $request->title2;
          $Banners-> description2=$request->description2;
          $Banners->update();

        return redirect()->route('admin.banner')->with(['success' => 'banner updated successfuly']);

    }
    public function show($id){
        $Banners=Banner::where('id',$id)->first();
        return view('admin.banner.show',compact('Banners'));
    }
    public function delete($id){
        try {
            $Banners = Banner::find($id);
            Storage::delete($Banners->photo1);
            Storage::delete($Banners->photo2);
            $Banners->delete();
            return redirect()->route('admin.banner')->with(['success' => 'banner deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.banner')->with(['error' => 'error: try again']);
        }
    }
}
