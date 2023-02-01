@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a>
                                </li>
                                <li class="breadcrumb-item active"> Add Banners</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form la
                yout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> Add Banners </h4>
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
                                        <form class="form" action="{{route('admin.banner.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> Banner Image 1 </label><br>
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
                                                            <label for="projectinput1"> Banner1 title - </label>
                                                            <input type="text" value="" id="title1"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="title1">
                                                            @error("title1")
                                                            <span class="text-danger">This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Banner1 description - </label>
                                                            <input type="text" value="" id="description1"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="description1">
                                                            @error("description1")
                                                            <span class="text-danger"> This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="form-group">
                                                <label> Banner Image 2 </label><br>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo2">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo2')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Banner1 Data </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Banner2 title - </label>
                                                            <input type="text" value="" id="title2"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="title2">
                                                            @error("title2")
                                                            <span class="text-danger">This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Banner2 description - </label>
                                                            <input type="text" value="" id="description2"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="description2">
                                                            @error("description2")
                                                            <span class="text-danger"> This Field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> Back
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
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
