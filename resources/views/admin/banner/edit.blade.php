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
                                <li class="breadcrumb-item"><a href="{{route('admin.banner')}}"> Banners </a>
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Banners </h4>
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
                                              action="{{route('admin.banner.update',$Banners -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$Banners->id}}" type="hidden">
                                                <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/banner/'.$Banners->photo1)}}"
                                                         class="w-16 h-16 rounded">
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label> Banner1 image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo1">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo1')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                                <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Banner1 Data </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Banner title1
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Banners -> title1}}"
                                                                   name="title1">
                                                            @error("title1")
                                                            <span class="text-danger"> This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> description1
                                                            </label>
                                                            <input id="description"
                                                                   class="form-control"
                                                                   value="{{$Banners -> description1}}"
                                                                   name="description1">
                                                            @error("description1")
                                                            <span class="text-danger">This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                            <br>
                                            <br>
                                            <br>

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/banner/'.$Banners->photo2)}}"
                                                         class="w-16 h-16 rounded">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label> Banner2 image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo2">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo2')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Banner2 Data </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Banner title2
                                                            </label>
                                                            <input type="text" id="title2"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Banners -> title2}}"
                                                                   name="title2">
                                                            @error("title2")
                                                            <span class="text-danger"> This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> description2
                                                            </label>
                                                            <input id="description2"
                                                                   class="form-control"
                                                                   value="{{$Banners -> description2}}"
                                                                   name="description2">
                                                            @error("description2")
                                                            <span class="text-danger">This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
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



