@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Main</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">Users</a>
                                </li>
                                <li class="breadcrumb-item active"> Edit Info
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Edit user </h4>
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
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.user.update',$Users -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$Users -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/user/'.$Users->photo)}}"
                                                         class="w-16 h-16 rounded">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>user photo </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>user data </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> First Name
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Users -> name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Last Name
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Users -> lname}}"
                                                                   name="lname">
                                                            @error("lname")
                                                            <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> email
                                                            </label>
                                                            <input type="email" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Users -> email}}"
                                                                   name="email">
                                                            @error("email")
                                                            <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> password</label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   value=""
                                                                   name="password">
                                                            @error("password")
                                                            <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">phone
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Users -> phone}}"
                                                                   name="phone">
                                                            @error("phone")
                                                            <span class="text-danger">this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Address </label>
                                                            <input type="text" value="{{$Users -> address}}"
                                                                   id="address"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="address">
                                                            @error("address")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Address2 </label>
                                                            <input type="text" value="{{$Users -> address}}"
                                                                   id="address2"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="address2">
                                                            @error("address2")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> City </label>
                                                            <input type="text" value="{{$Users -> city}}" id="city"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="city">
                                                            @error("city")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Country </label>
                                                            <input type="text" value="{{$Users -> country}}"
                                                                   id="country"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="country">
                                                            @error("country")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Pin Code </label>
                                                            <input type="number" value="{{$Users -> pincode}}"
                                                                   id="pincode"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="pincode">
                                                            @error("pincode")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Role </label>
                                                            <input type="text" value="{{$Users->role}}" id="role"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="role">
                                                            @error("role")
                                                            <span class="text-danger">  field require</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($Users -> active == 1)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @error("active")
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> back
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> update
                                                </button>
                                            </div>


                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection



