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
                                <li class="breadcrumb-item active">Add Team Member
                                </li>
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
                                    <h4 class="card-title" id="basic-layout-form"> Add Team Member </h4>
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
                                        <form class="form" action="{{route('admin.team_member.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> Team_member Image </label><br>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Team_members Data </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Name </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> This Field Is Required</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Title </label>
                                                                <input type="text" value="" id="name"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       name="title">
                                                                @error("title")
                                                                <span class="text-danger">This Field Is Required</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                 <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> Description </label>
                                                                    <textarea name="description" rows="3" id='description' class="form-control border p-2"></textarea>
                                                                    @error("description")
                                                                    <span class="text-danger">This Field Is Required</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                </div>
                                                 <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="btn_text">Button Text</label>
                                                                    <input type="text" name="btn_text" id="btn_text" class="form-control border p-2">
                                                                    @error("btn_text")
                                                                    <span class="text-danger">This Field Is Required</span>
                                                                    @enderror
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
                                            </div>
                                        </form>
                                    </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
            </div>

                <!-- // Basic form layout section end -->
            </div>
        </div>


@endsection
