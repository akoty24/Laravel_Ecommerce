<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(){
        $Slider = Slider::all();
        return view('admin.slider.index', compact('Slider'));
    }
    public function create(){
        return view('admin.slider.create');
    }
    public function store(SliderRequest $request){
        $Slider =new Slider();

        if($request->file('photo')) {
            $file = $request->file('photo');
            $image = date('photo') . $file->getClientOriginalName();
            $file->move(public_path('front/photos/slider'), $image);
            $Slider['photo'] = $image;
        }

        $Slider->name=$request->name;
        $Slider->description=$request->description;
        $Slider->subdescription=$request->subdescription;
        $Slider->price=$request->price;
        $Slider->link=$request->link;
        $Slider->save();
        return redirect()->back()->with(['success' =>' Slider added successfuly']);

    }
    public function edit($id){
        $Slider = Slider::selection()->find($id);

        if (!$Slider)
            return redirect()->route('admin.slider')->with(['error' => 'slider no found']);

        return view('admin.slider.edit', compact('Slider'));

    }
    public function update($id,SliderRequest $request){

        $Slider= Slider::find($id);
        if(!$Slider){
            return redirect()->back()->with(['error' => 'slider not found']);
        }

        if ($request->hasFile('photo')) {
            $path = 'front/photos/slider/'.$Slider->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('photo');
            $ext = $file->extension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('front/photos/slider/'), $filename);
            $Slider->photo = $filename;
        }
        $Slider->name = $request->name;
        $Slider->price = $request->price;
        $Slider->description = $request->description;
        $Slider->subdescription = $request->subdescription;
        $Slider->link = $request->link;
        $Slider->update();
        return redirect()->route('admin.slider')->with(['success' => 'Slider updated successfuly']);

    }
    public function show($id){
        $sliders=Slider::where('id',$id)->first();
        return view('admin.slider.show',compact('sliders'));
    }
    public function delete($id){
        try {
            $Slider = Slider::find($id);
            Storage::delete($Slider->photo);
            $Slider->delete();
            return redirect()->route('admin.slider')->with(['success' => 'Slider deleted successfuly']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.slider')->with(['error' => 'error: try again']);
        }
    }
}
