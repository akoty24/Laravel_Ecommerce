<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    public function index(Request $request)
{
    if ($request->start_date && $request->end_date ) {

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if ($end_date->greaterThan($start_date)) {
            $orders = Order::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $orders = Order::latest()->get();
        }
    }

    else if ($request->max_price && $request->min_price) {
        $max = $request->max_price;
        $min = $request->min_price;
        if ($max >= $min) {
            $orders = Order::whereBetween('total_price', [$min, $max])->get();
        } else {
            $orders = Order::latest()->get();
        }
    }
    else {
        $orders = Order::latest()->get();
    }

//    if ($request->start_date && $request->end_date || $request->max_price && $request->min_price ) {
//        $max=$request->max_price;
//        $min=$request->min_price;
//        $start_date = Carbon::parse($request->start_date);
//        $end_date = Carbon::parse($request->end_date);
//
//        if ($end_date->greaterThan($start_date) || $max->greaterThan($min)) {
//            $orders = Order::whereBetween('created_at', [$start_date, $end_date])
//                ->whereBetween('total_price',[$min, $max])->get();
//        }
//        else {
//            $orders = Order::latest()->get();
//        }
//    }
//    else {
//        $orders = Order::latest()->get();
//    }
    return view('admin.order.index', compact('orders'));
}
    public function show($id){
        $orders = Order::where('id',$id)->first();
    return view('admin.order.show', compact('orders'));
}

    public function delete($id){
        try {
            $orders = Order::find($id);
            $orders->delete();
            return redirect()->route('admin.order')->with(['success' => 'order deleted successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.order')->with(['error' => 'error: try again']);
        }
    }
    public function downloadInvoice($id){

        $orders = Order::where('id',$id)->first();
        $data=['orders'=>$orders];
        $pdf = Pdf::loadView('admin.order.show',$data);
        $todaydata=Carbon::now()->format('d-m-y');
       // return $pdf->download('fundaofwebit.pdf');
        return $pdf->download('invoice'.$id.'_'.$todaydata.'.pdf');
    }
}



