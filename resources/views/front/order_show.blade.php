@extends('front.layouts.app');
@section('contant')
    @include('admin.includes.alerts.alert')
    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.sweet_alert')
    @include('admin.includes.alerts.error')
    <main id="main" class="main-site">
        <div class="container">
            <div class="app-content content">
                <div class="content-wrapper">
                    <div class="content-body">
                        <!-- DOM - jQuery events table -->
                        <section id="dom">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="card">
                                        <div class="row col-lg-12">
                                            <a class="btn btn-primary" style="float: right"
                                               href="{{route('user.order')}}"><i class="fa fa-arrow-circle-left"
                                                                                 aria-hidden="true"></i>Back</a>
                                            <h4 class="card-title" style="font-size: 20px">order details</h4>
                                        </div>
                                        <div class="card-content collapse show">
                                            <table class="table display nowrap table-striped table-bordered scroll">
                                                <thead class="">
                                                <tr>
                                                    <th>product name</th>
                                                    <th>photo</th>
                                                    <th>quantity</th>
                                                    <th>price</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @isset($orders)
                                                    @foreach($orders->items as $order)
                                                        <tr>
                                                            <td>{{$order->products->name}}</td>
                                                            <td><img style="width: 100px; height: 100px;" src="{{ url('front/photos/product/'.$order->products->photo)}}" class="w-16 h-16 rounded"></td>
                                                            <td>{{$order -> quantity}}</td>
                                                            <td>${{$order -> price}}</td>
                                                            <td>
                                                                <div>
                                                                    @if($orders->status() == 'delivered' && $order->rstatus == true)
                                                                        <a class="btn btn-success" style="float: right "
                                                                           href="{{route('user.review',$order->id)}}">add
                                                                            review</a>
                                                                    @else
                                                                        <button class="btn btn-dark" style="float: right">canceled</button>

                                                                    @endif
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endisset


                                                </tbody>
                                            </table>
                                            <div class="col-lg-8 text-center">
                                                <div class="summary">
                                                    <div class="order-summary">
                                                        <p class="summary-info"><span class="title"
                                                                                      style=" font-weight: bold; color: #0a0e45; font-size: 23px">total price</span><b
                                                                    class="index" style="color: red; font-size: 20px">
                                                                ${{$orders -> total_price}}</b></p>
                                                        <br> <br>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection