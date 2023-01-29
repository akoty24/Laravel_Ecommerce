@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Main orders </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Main</a>
                                </li>
                                <li class="breadcrumb-item active"> Orders
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">all orders</h4>
                                    <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.alert')
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.sweet_alert')
                                @include('admin.includes.alerts.error')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                       <div>
                                           <form action="{{route('admin.order')}}" method="GET" >
                                               <div class="row">
                                                   <div class="col-md-2">
                                                       <label >:start date</label>
                                                       <input type="date"  name="start_date" placeholder="start date" value="{{date('y-m-d')}}" class="form-control" style="height: 40px">
                                                   </div>
                                                   <div >
                                                       <label >:end date</label>
                                                       <input type="date" name="end_date" value="{{date('y-m-d')}}" class="form-control" style="height: 40px">
                                                   </div>

                                                   <div class="col-md-2">
                                                       <label >:min price</label>
                                                       <input type="number" name="min_price" placeholder="min price"  class="form-control" style="height: 40px">
                                                   </div>
                                                   <div >
                                                       <label >:max price</label>
                                                       <input type="number" name="max_price" placeholder="max price"  class="form-control" style="height: 40px">

                                                   </div>
                                                   <div  class="col-md-2" style="margin-top: 30px">
                                                       <button id="filter" type="submit" class="btn btn-info">Filter</button>
                                                       <button id="reset" class="btn btn-warning ">Reset</button>
                                                   </div>
                                               </div>
                                           </form>

                                       </div>
                                        <table class="table display nowrap table-striped table-bordered scroll-horizontal">

                                            <thead class="">
                                            <tr style="color: white; font-size: 16px; text-align: center; background-color: #150b53; ">
                                                <th>Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Total Price</th>
                                                <th>status</th>
                                                <th>actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($orders)
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order -> id}}</td>
                                                        <td>{{$order -> fname}}</td>
                                                        <td>{{$order -> lname}}</td>
                                                        <td>{{$order -> total_price}}</td>
                                                        <td>{{$order -> status()}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{route('admin.order.show',$order->id)}}"
                                                                   class="btn btn-outline-amber btn-min-width box-shadow-3 mr-1 mb-1">show<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="{{route('admin.order.download',$order->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Print Invoice</a>
                                                                <a href="{{route('admin.order.delete',$order->id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

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
@endsection


