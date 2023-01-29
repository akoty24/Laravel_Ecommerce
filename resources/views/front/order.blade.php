@extends('front.layouts.app');
@section('contant')

    @include('admin.includes.alerts.alert')
    @include('admin.includes.alerts.success')
    @include('admin.includes.alerts.sweet_alert')
    @include('admin.includes.alerts.error')
    <main id="main" class="main-site">
        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>my order</span></li>
                </ul>
            </div>
            @if($orders->count()>0)
                <table class="table table-striped table-hover table-reflow">
                    <thead class="">
                    <tr>
                        <th>Order Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Pin Code</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>actions</th>
                    </tr>
                    </thead>

                    @isset($orders)
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order -> id}}</td>
                                <td>{{$order -> fname}}</td>
                                <td>{{$order -> lname}}</td>
                                <td>{{$order -> email}}</td>
                                <td>{{$order -> phone}}</td>
                                <td>{{$order -> pincode}}</td>
                                <td>{{$order -> status()}}</td>
                                <td>{{$order -> created_at}}</td>
                                <td>{{$order -> total_price}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{route('user.order.showDetails',$order->id)}}"
                                           style="background-color: #0a53be; color: white"
                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">show<i
                                                    class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                        <hr>
                                        <a href="{{route('user.ordersatuts.update',$order->id)}}"
                                           style="background-color: #0a53be; color: white"
                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">cancel</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    <tbody>
                    </tbody>
                </table>
            @else
                <div class="text-center" style="color: red; font-weight: bold; font-size: 30px"> NO Orders</div>
                <br>
                <div class="checkout-info" style="float: right">
                    <a class="btn btn-primary" href="{{route('shop')}}">Continue Shopping<i
                                class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            @endif
        </div>
    </main>
@endsection