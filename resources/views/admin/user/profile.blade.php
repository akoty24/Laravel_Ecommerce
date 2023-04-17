@extends('front.layouts.app');
@section('contant')

    <html  lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Material Design for Bootstrap</title>
        <!-- MDB icon -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <style>
            body {
                margin: 0;
                color: #2e323c;
                background: #f5f6fa;
                position: relative;
                height: 100%;
            }
            .account-settings .user-profile {
                margin: 0 0 1rem 0;
                padding-bottom: 1rem;
                text-align: center;
            }
            .account-settings .user-profile .user-avatar {
                margin: 0 0 1rem 0;
            }
            .account-settings .user-profile .user-avatar img {
                width: 90px;
                height: 90px;
                -webkit-border-radius: 100px;
                -moz-border-radius: 100px;
                border-radius: 100px;
            }
            .account-settings .user-profile h5.user-name {
                margin: 0;

            }
            .account-settings .user-profile h6.user-email {
                margin: 0;
                font-weight: 400;
                color: grey;
            }
            .account-settings .about {
                margin: 2rem 0 0 0;
                text-align: center;
            }
            .account-settings .about h5 {
                margin: 0 0 15px 0;
                color: #007ae1;
            }
            .account-settings .about p {
                font-size: 0.825rem;
            }
            .form-control {
                border: 1px solid #cfd1d8;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                font-size: 12px;
                background: #ffffff;
                color: #2e323c;
            }

            .card {
                background: #ffffff;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 0;
                margin-bottom: 1rem;
            }

        </style>
        <title>edit profile</title>
    </head>
    <body>
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body" style="margin: 30px">
                        <div class="account-settings">
                            <div class="user-profile">

                                @if(Auth::user()->photo)
                                    <img src="{{url('front/photos/user/'.$user->photo)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;border-radius: 50%">
                                @else
                                    <img src="{{asset('front/photos/user/download.png')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;border-radius: 50%">
                                @endif

                                <h4 class="user-name" style="overflow-inline: visible">{{$user->name}} {{$user->lname}}</h4>
                                <h6 class="user-email">{{$user->email}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body" style="margin: 30px">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h3 class="mb-2 text-primary"> Personal Details</h3>
                            </div>
                            <form  method="get" action="{{route('edit.profile',$user->id)}}">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">First Name</label>
                                    <input disabled type="text" name="name" class="form-control" id="fullName" value="{{$user->name}}">
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Last Name</label>
                                    <input disabled type="text" name="lname" class="form-control" id="fullName" value="{{$user->lname}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input disabled type="email" name="email" class="form-control" id="eMail" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input disabled type="tel" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                                </div>
                            </div>
                                @if(Auth::user()->address)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input disabled type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
                                </div>
                            </div>
                                @endif
                                @if(Auth::user()->address2)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="address2">Address2</label>
                                    <input disabled type="text" class="form-control" name="address2" id="address2" value="{{$user->address2}}">
                                </div>
                            </div>
                                @endif
                                @if(Auth::user()->country)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="country">country</label>
                                    <input disabled type="text" name="country" class="form-control" id="country" value=" {{$user->country}}">
                                </div>
                            </div>
                                @endif
                                    @if(Auth::user()->city)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ciTy">City</label>
                                    <input disabled type="text" name="city" class="form-control" id="ciTy" value="{{$user->city}}">
                                </div>
                            </div>
                                    @endif
                                        @if(Auth::user()->pincode)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zIp">Zip Code</label>
                                    <input disabled type="number" name="pincode" class="form-control" id="zIp" value="{{$user->pincode}}">
                                </div>
                            </div>
                                    @endif
                          <button type="submit" id="submit" name="submit" class="btn btn-primary">edit</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
    </html>
    <br>
    <br>

@endsection
