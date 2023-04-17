@extends('front.layouts.app');
@section('contant')

    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><a href="{{route('shop')}}" class="link">shop</a></li>
                    <li class="item-link"><span>detail</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-product-detail">
                        <div class="detail-media">
                            <div class="product-gallery">
                                <ul class="slides">
                                    <li data-thumb="{{url('front/photos/product/'.$products->photo)}}">
                                        <img src="{{url('front/photos/product/'.$products->photo)}}"
                                             alt="{{$products->name}}"/>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="detail-info">
                            <h2 class="productname">{{$products->name}}</h2>
                            <div>
                                <span style="font-size: 20px">Category</span>
                                <span style="color:darkgrey">{{$products->category->name}}</span>
                                <br>
                                <span style="color:darkgrey">{{$products->description}}</span>
                            </div>
                            <style>
                                .color-gray {
                                    color: #cacaca !important;
                                }
                            </style>
                            @if(App\models\Review::where('product_id',$products->id)->first())
                                @php
                                    $reviews=App\models\Review::where('product_id',$products->id)->get();
                                    $rating=App\models\Review::where('product_id',$products->id)->avg('rating');
                                    $avgrating=number_format($rating,1);
                                @endphp
                                @for($i=1; $i<=5; $i++)
                                    @if($i<=$avgrating)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star color-gray"></i>
                                    @endif
                                @endfor
                            @else
                                <i class="fa fa-star color-gray"></i>
                                <i class="fa fa-star color-gray"></i>
                                <i class="fa fa-star color-gray"></i>
                                <i class="fa fa-star color-gray"></i>
                                <i class="fa fa-star color-gray"></i>
                            @endif
                            <div class="product-rating">
                                @if($reviews->count()>0)
                                    <a href="#review" class="count-review">. {{$reviews->count()}} review(s)</a>
                                @else
                                    <span class="text-danger">no review</span>
                                @endif
                            </div><br>


{{--                                                    <div class="wrap-social">--}}
{{--                                                        <a class="link-socail" href="#"><img src="{{asset('assets/images/social-list.png')}}" alt="{{$products->name}}"></a>--}}
{{--                                                    </div>--}}
                            <div class="wrap-price"><span class="product-price"
                                                          style="color: red">${{$products->price}}</span></div>
                            <div class="stock-info in-stock">
                                {{--                            <p class="availability">Availability: <b>In Stock</b></p>--}}
                            </div>
                            <div class="wrap-butons">

                                <form action="{{route('add.to.cart',$products->id)}}" method="POST">
                                    @csrf
                                    @if($products->quantity>1)
                                        <div class="quantity">
                                            <span>Quantity:</span>
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" class="form-control" min="1" style="width:70px"
                                                   name="quantity" value="1" data-max="120" pattern="[0-9]*">
                                        </div>
                                        <br>
                                        <br>
                                        <input href="" class="btn add-to-cart" value="Add To Cart" type="submit">
                                    @else
                                        <button class="btn btn-wishlist" disabled>out of stock</button>
                                    @endif
                                    {{--				<a href="" class="btn add-to-cart"  type="submit">Add To Cart</a>--}}
                                </form>

                                <form action="{{route('add.to.wishlist',$products->id)}}" method="POST">
                                    @csrf
                                    <input href="" class="btn add-to-cart" value="add to wishlist" type="submit">
                                </form>
                            </div>
                        </div>
                        <div class="advance-info">
                            <div class="tab-control normal">
                                <a href="#description" class="tab-control-item active">description</a>
                                <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                                <a href="#review" class="tab-control-item">Reviews</a>
                            </div>
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="description">
                                    {{$products->longdescription}}
                                </div>
                                <div class="tab-content-item " id="add_infomation">
                                    <table class="shop_attributes">
                                        <tbody>
                                        <tr>
                                            <th>Weight</th>
                                            <td class="product_weight">1 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td><p>Black, Blue, Grey, Violet, Yellow</p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-content-item " id="review">
                                    <div class="wrap-review-form">
                                        @if($reviews->count()<1)
                                            <span style="font-size: 25px">No reviews </span>
                                        @else
                                            <span style="font-size: 25px">Top reviews </span>
                                        @endif
                                        @foreach($reviews as $review)

                                            <div id="comments">
                                                <ol class="commentlist">
                                                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                        id="li-comment-20">
                                                        <div id="comment-20" class="comment_container">
                                                            <img alt=""
                                                                 src="{{url('front/photos/user/'.$review->users->photo)}}"
                                                                 height="40" width="40">
                                                            <div class="comment-text">
                                                                <p class="meta">
                                                                    <strong class="woocommerce-review__author">{{$review->users->name}}
                                                                        <span>{{$review->users->lname}}</span></strong>
                                                                </p>
                                                                @for($i=1; $i<=5; $i++)
                                                                    @if($i<=$review->rating)
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="fa fa-star color-gray"></i>
                                                                    @endif
                                                                @endfor
                                                                <br>
                                                                <span class="">Reviewed in {{$review->users->country}} on</span>

                                                                <time class="woocommerce-review__published-date"
                                                                      datetime="2008-02-14 20:00">{{$review->created_at}}</time>

                                                                <div class="description">
                                                                    <p>{{$review->comment}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div><!-- #comments -->
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">
                                @foreach($popular_products as $popular_product)
                                    <li class="product-item">
                                        <div class="product product-widget-style">
                                            <div class="thumbnnail">
                                                <a href="{{route('product.detail',$popular_product->id)}}"
                                                   title="{{$popular_product->name}}">
                                                    <figure><img
                                                                src="{{url('front/photos/product/'.$popular_product->photo)}}"
                                                                alt="{{$popular_product->name}}"></figure>
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{route('product.detail',$popular_product->id)}}"
                                                   class="product-name"><span>{{$popular_product->description}}</span></a>
                                                @if(App\models\Review::where('product_id',$popular_product->id)->first())
                                                    @php
                                                        $reviews=App\models\Review::where('product_id',$popular_product->id)->get();
                                                        $rating=App\models\Review::where('product_id',$popular_product->id)->avg('rating');
                                                        $avgrating=number_format($rating,1);
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i<=$avgrating)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @else
                                                            <i class="fa fa-star color-gray"></i>
                                                        @endif
                                                    @endfor
                                                @else
                                                    <i class="fa fa-star color-gray"></i>
                                                    <i class="fa fa-star color-gray"></i>
                                                    <i class="fa fa-star color-gray"></i>
                                                    <i class="fa fa-star color-gray"></i>
                                                    <i class="fa fa-star color-gray"></i>
                                                @endif
                                                <div class="product-rating">
                                                    @if($reviews->count()>0)
                                                        <a href="#review" class="count-review">. {{$reviews->count()}}
                                                            review(s)</a>
                                                    @else
                                                        <span class="text-danger">no review</span>
                                                    @endif
                                                </div>

                                                <div class="wrap-price"><span
                                                            class="product-price">${{$popular_product->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div><!--end sitebar-->

                <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wrap-show-advance-info-box style-1 box-in-site">
                        <h3 class="title-box">Related Products</h3>
                        <div class="wrap-products">
                            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                                 data-loop="false" data-nav="true" data-dots="false"
                                 data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                                @foreach($related_products as $related_product)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{route('product.detail',$related_product->id)}}"
                                               title="{{$related_product->name}}">
                                                <figure><img
                                                            src="{{url('front/photos/product/'.$related_product->photo)}}"
                                                            width="214" height="214" alt="{{$related_product->name}}">
                                                </figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                        </div>

                                        <div class="product-info">
                                            <a href="{{route('product.detail',$related_product->id)}}"
                                               class="product-name"><span>{{$related_product->name}}</span>
                                            </a>
                                            @if(App\models\Review::where('product_id',$related_product->id)->first())
                                                @php
                                                    $reviews=App\models\Review::where('product_id',$related_product->id)->get();
                                                    $rating=App\models\Review::where('product_id',$related_product->id)->avg('rating');
                                                    $avgrating=number_format($rating,1);
                                                @endphp
                                                @for($i=1; $i<=5; $i++)
                                                    @if($i<=$avgrating)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star color-gray"></i>
                                                    @endif
                                                @endfor
                                            @else
                                                <i class="fa fa-star color-gray"></i>
                                                <i class="fa fa-star color-gray"></i>
                                                <i class="fa fa-star color-gray"></i>
                                                <i class="fa fa-star color-gray"></i>
                                                <i class="fa fa-star color-gray"></i>
                                            @endif
                                            <div class="product-rating">
                                                @if($reviews->count()>0)
                                                    <a href="#review" class="count-review">. {{$reviews->count()}}
                                                        review(s)</a>
                                                @else
                                                    <span class="text-danger">no review</span>
                                                @endif
                                            </div>

                                            <div class="wrap-price"><span
                                                        class="product-price">${{$related_product->price}}</span></div>
                                            <div class="product-name" style="color: gray"><span style="color: gray">{{$related_product->description}}</span></div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div><!--End wrap-products-->
                    </div>
                </div>

            </div><!--end row-->

        </div><!--end container-->

    </main>
    <!--main area-->
@endsection