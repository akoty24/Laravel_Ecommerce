<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/color-01.css')}}">

</head>
<body class="home-page home-01">

<!-- mobile menu -->
<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<!--header-->
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item" >
                                <a title="Hotline: (+20) 1027401686" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+20) 1027401686</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>

@if(Route::has('login'))
    @auth
        @if(Auth::user()->role == 'ADM')

                                        <li class="menu-item " >
                                            <a title="show your order" href="{{route('user.order')}}">My Order
                                                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" style="color: white; background-color: red">{{\App\Models\Order::where('user_id',Auth::id())->count()}}</span>
                                            </a>

                                        </li>
                                        <li class="menu-item menu-item-has-children parent" >
                                            <a title="Dollar (USD)" href="#">
                                                <span class="avatar avatar-online">
                                                 <img  style="height: 35px;width: 35px; border-radius: 50%" src="{{url('front/photos/user/'.Auth::user()->photo)}}" alt="avatar"><i> </i></span>
                                                {{Auth::user()->name}}<i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </a>
                                            <ul class="submenu curency" >
                                                <li class="menu-item" >
                                                    <a title="Pound (GBP)" href="{{route('admin.dashboard')}}">Dashboard</a>
                                                </li>
                                                <li class="menu-item" >
                                                    <a href="{{route('profile')}}"> profile </a>
                                                </li>
                                                <li class="menu-item" >
                                                <a href="{{route('logout')}}"> LOGOUT </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @else

                                        <li class="menu-item menu-item-has-children parent" >
                                            <a title="show your order" href="{{route('user.order')}}">My Order
                                                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" style="color: white; background-color: red">{{\App\Models\Order::where('user_id',Auth::id())->count()}}</span>
                                            </a>

                                            <a title="Dollar (USD)" href="#">
                                                <span class="avatar avatar-online">
                                                <img  style="height: 35px;width: 35px; border-radius: 50%" src="{{url('front/photos/user/'.Auth::user()->photo)}}" alt="avatar"><i> </i></span>
                                                {{Auth::user()->name}}<i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </a>

                                            <ul class="submenu curency" >

                                                <li class="menu-item" >
                                                    <a href="{{route('profile')}}"> profile </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('logout')}}"> LOGOUT </a>
                                                </li>

                                            </ul>

                                        </li>
                                    @endif
                                @else
                                    <li class="menu-item"><a title="" href="{{route('register.and.login')}}">Register</a> </li>
                                    <li class="menu-item"><a title="" href="{{route('register.and.login')}}">Login</a> </li>

                                @endif
                            @endif
                        </ul>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="{{route('index')}}" class="link-to-home"><img src="{{asset('assets/images/logo-top-1.png')}}" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{route('search')}}" id="form-search-top"  name="form-search-top">
                                @csrf
                                <input type="text" name="search" value="" placeholder="Search here...">
                                <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
{{--                                <div class="wrap-list-cate">
                                    <input type="hidden" name="product_cate" value="0" id="product-cate">
                                    <a href="#" class="link-control">All Category</a><ul class="list-cate">
                                        <li class="level-0">All Category</li>
                                            <li class="level-1"></li>
                                    </ul>
                                </div>
--}}
                            </form>
                        </div>
                    </div>

                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section minicart">
                            <a href="{{route('show.wishlist')}}" class="link-direction">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                @if(Route::has('login'))
                                    @auth
                                <div class="left-info">
                                    <span class="index">{{\App\Models\WishList::where('user_id',\Illuminate\Support\Facades\Auth::id())->count()}} item</span>
                                    <span class="title">Wishlist</span>
                                </div>
                                    @else
                                        <div class="left-info">
                                                <span class="index">0 item</span>
                                            <span class="title">Wishlist</span>
                                        </div>
                                    @endif
                                @endif
                            </a>
                        </div>
                        <div class="wrap-icon-section minicart">
                            <a href="{{route('show.cart')}}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                @if(Route::has('login'))
                                    @auth
                                <div class="left-info">

                                     <span class="index">{{\App\Models\Cart::where('user_id',\Illuminate\Support\Facades\Auth::id())->count()}} item</span>

                                    <span class="title">CART</span>
                                </div>
                                    @else
                                        <div class="left-info">
                                                <span class="index">0 items</span>
                                            <span class="title">CART</span>
                                        </div>
                                    @endif
                                @endif
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">


                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="{{route('index')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('about')}}" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('shop')}}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('contact')}}" class="link-term mercado-item-title">Contact Us</a>
                            </li>
                            <li class="menu-item " >
                                <a title="show your order" href="{{route('show.cart')}}">Cart
                                    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" style="color: white; background-color: red">{{\App\Models\Cart::where('user_id',Auth::id())->count()}}</span>
                                </a>
                            </li>

                            <li class="menu-item " >
                                <a title="show your order" href="{{route('user.order')}}">Orders
                                    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" style="color: white; background-color: red">{{\App\Models\Order::where('user_id',Auth::id())->count()}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('contant')

<footer id="footer" style=" margin-top: auto;">
    <div class="wrap-footer-content footer-style-1" style=" margin-top: auto;">


        <!--End function info-->



        <div class="coppy-right-box">
            <div class="container">
                <div class="coppy-right-item item-left">
                    <p class="coppy-right-text">Copyright © 2020 Surfside Media. All rights reserved</p>
                </div>
                <div class="coppy-right-item item-right">
                    <div class="wrap-nav horizontal-nav">
                        <ul>
                            <li class="menu-item"><a href="{{route('about')}}" class="link-term">About us</a></li>
                            <li class="menu-item"><a href="" class="link-term">Privacy Policy</a></li>
                            <li class="menu-item"><a href="" class="link-term">Terms & Conditions</a></li>
                            <li class="menu-item"><a href="" class="link-term">Return Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.flexslider.js')}}"></script>
<script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
<script src="{{asset('assets/js/functions.js')}}"></script>
<script src="{{asset('assets/js/checkout.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('custom-js')

</body>
</html>