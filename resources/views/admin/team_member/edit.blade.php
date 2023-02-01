@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.team_member')}}"> Team_members </a>
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Team_member </h4>
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
                                             action="{{route('admin.team_member.update',$members -> id)}}"
                                             method="POST"
                                             enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$members -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/member/'.$members->photo)}}"
                                                         class="w-16 h-16 rounded">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label> member image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> edit name
                                                                <input type="text" id="name"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{$members -> name}}"
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
                                                            <label for="projectinput1"> edit title
                                                                <input type="text" id="title"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{$members -> title}}"
                                                                       name="title">
                                                                @error("title")
                                                                <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="description" rows="3" id='description' class="form-control border p-2">{{ $members->description }}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> this field is required</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> edit btn_text
                                                                <input type="text" id="name"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{$members -> btn_text}}"
                                                                       name="btn_text">
                                                                @error("btn_text")
                                                                <span class="text-danger"> this field is required</span>
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
            </div>
                <!-- // Basic form layout section end -->
            </div>
        </div>

@endsection
