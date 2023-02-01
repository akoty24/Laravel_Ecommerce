@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Main users </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.user')}}">Users</a></li>
                                <li class="breadcrumb-item active">Show User</li>
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
                                    <h4 class="card-title">show info </h4>
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
                                        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr style="color: white; font-size: 16px; text-align: center; background-color:#150b53  ">
                                                <th>Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>photo</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Address2</th>
                                                <th>City</th>
                                                <th>Country</th>
                                                <th>Pincode</th>
                                                <th>Type</th>
                                                <th>Stutas</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$user -> id}}</td>
                                                <td>{{$user -> name}}</td>
                                                <td>{{$user -> lname}}</td>
                                                <td><img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/user/'.$user->photo)}}"
                                                         class="w-16 h-16 rounded"></td>
                                                <td>{{$user ->email}}</td>
                                                <td>{{$user -> phone}}</td>
                                                <td>{{$user -> address}}</td>
                                                <td>{{$user -> address2}}</td>
                                                <td>{{$user -> city}}</td>
                                                <td>{{$user -> country}}</td>
                                                <td>{{$user -> pincode}}</td>
                                                <td>{{$user -> role}}</td>
                                                <td>{{$user -> getActive()}}</td>
                                            </tr>
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
