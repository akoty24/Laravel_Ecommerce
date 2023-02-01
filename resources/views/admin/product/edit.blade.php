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
                                <li class="breadcrumb-item"><a href="{{route('admin.product')}}"> Products </a>
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Product </h4>
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
                                              action="{{route('admin.product.update',$Products -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$Products -> id}}" type="hidden">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img style="width: 150px; height: 100px;"
                                                         src="{{ url('front/photos/product/'.$Products->photo)}}"
                                                         class="w-16 h-16 rounded">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>product image </label>
                                                <label id="projectinput7" class="file center-block">  </label>
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> edit name</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Products -> name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> edit price</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Products -> price}}"
                                                                   name="price">
                                                            @error("price")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                        @enderror
                                                    </div>
                                                      </div>
                                                    </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> edit quantity</label>
                                                            <input type="number" id="quantity"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$Products->quantity}}"
                                                                   name="quantity">
                                                            @error("quantity")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Edit Description </label>
                                                        <textarea type="text" value="" id="name"
                                                                  class="form-control"
                                                                  placeholder=" edit the description "
                                                                  name="description">{{$Products->description}}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Edit Long Description</label>
                                                        <textarea name="longdescription"  placeholder=" edit the long description " rows="3" style="max-width: 100%; " class="form-control border p-2">{{$Products->longdescription}}</textarea>
                                                            @error("longdescription")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                          @enderror
                                                    </div>

                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> edit Category_id </label>
                                                            <input type="number" min=1 id="Category_id"
                                                                   class="form-control"
                                                                   value="{{$Products->category_id}}"
                                                                   name="Category_id">
                                                            @error("Category_id")
                                                            <span class="text-danger"> This Field  Is Required</span>
                                                        @enderror
                                                    </div>
                                                </div>
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
                                                                   @if($Products -> active == 1)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">status </label>

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
