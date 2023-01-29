@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Main Messages </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Main</a>
                                </li>
                                <li class="breadcrumb-item active">Messages
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
                                    <h4 class="card-title">all Messages </h4>
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
                                        <table
                                                class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr style="color: white; font-size: 16px; text-align: center; background-color:#150b53  ">
                                                <th>Id</th>
                                                <th>first Name</th>
                                                <th>Actions</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($messages)
                                                @foreach($messages as $message)
                                                    <tr>
                                                        <td>{{$message -> id}}</td>
                                                        <td>{{$message -> fname}}</td>
                                                       <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.message.show',$message ->id)}}"
                                                                   class="btn btn-outline-amber btn-min-width box-shadow-3 mr-1 mb-1">show</a>
                                                                 <a href="{{route('admin.message.delete',$message->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">delete</a>
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
