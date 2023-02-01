@extends('front.layouts.app');
@section('contant')
    <main id="main" class="main-site">
        <div class="container">
            <div class="app-content content">
                <div class="content-wrapper">
                    <div class="content-body">
                        <!-- DOM - jQuery events table -->
                        <section id="dom">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="card" id="review">
                                        <div class="wrap-review-form">
                                            <h3>Add Review For
                                                <a class="link-to-product"
                                                   href="{{route('product.detail',$order_item->products->id)}}">
                                                    <span style="color:red;"> {{$order_item->products->name}}</span>
                                                </a>
                                            </h3><br>
                                            @include('admin.includes.alerts.alert')
                                            @include('admin.includes.alerts.success')
                                            @include('admin.includes.alerts.sweet_alert')
                                            @include('admin.includes.alerts.error')
                                            <div id="comments">
                                                <ol class="commentlist">
                                                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                        id="li-comment-20">
                                                        <div id="comment-20" class="comment_container">
                                                            <img alt=""
                                                                 src="{{url('front/photos/product/'.$order_item->products->photo)}}"
                                                                 height="150" width="150">
                                                            <div class="comment-text">
                                                                <p class="meta">
                                                                    <a class="link-to-product"
                                                                       href="{{route('product.detail',$order_item->products->id)}}">

                                                                        <strong class="woocommerce-review__author">{{$order_item->products->name}}</strong>
                                                                    </a>
                                                                    <span class="woocommerce-review__dash">–</span>
                                                                    <time class="woocommerce-review__published-date"
                                                                          datetime="2008-02-14 20:00"
                                                                          style="color: red">
                                                                        ${{$order_item->products->price}}</time>
                                                                </p>
                                                                <div class="description">
                                                                    {{$order_item->products->description}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div><!-- #comments -->
                                            <div id="review_form_wrapper">
                                                <div id="review_form">
                                                    <div id="respond" class="comment-respond">

                                                        <form action="{{route('submit.review')}}" method="POST"
                                                              id="commentform" class="comment-form" novalidate="">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                   value=" {{$order_item->products->id}}">
                                                            <input type="hidden" name="order_item_id"
                                                                   value=" {{$order_item->id}}">
                                                            <div class="comment-form-rating">
                                                                <span style="font-size: 14px;">Your rating<span
                                                                            style="color: red">*</span></span>
                                                                <p class="stars">
                                                                    <label for="rated-1"></label>
                                                                    <input type="radio" id="rated-1" name="rating"
                                                                           value="1">
                                                                    <label for="rated-2"></label>
                                                                    <input type="radio" id="rated-2" name="rating"
                                                                           value="2">
                                                                    <label for="rated-3"></label>
                                                                    <input type="radio" id="rated-3" name="rating"
                                                                           value="3">
                                                                    <label for="rated-4"></label>
                                                                    <input type="radio" id="rated-4" name="rating"
                                                                           value="4">
                                                                    <label for="rated-5"></label>
                                                                    <input type="radio" name="rating" value="5"
                                                                           checked="checked">
                                                                    @error("rating")
                                                                    <span class="text-danger">This field is required</span>
                                                                    @enderror
                                                                </p>
                                                            </div>
                                                            <br>
                                                            <p class="comment-form-comment">
                                                                <label for="comment" style="font-size: 14px;">Your
                                                                    review <span class="required"><span
                                                                                style="color: red">*</span></span>
                                                                </label>
                                                                <textarea id="comment" name="comment" cols="45"
                                                                          rows="8"></textarea>
                                                                @error("comment")
                                                                <span class="text-danger">This field is required</span>
                                                                @enderror
                                                            </p>
                                                            <p class="form-submit">
                                                                <input name="submit" type="submit" id="submit"
                                                                       class="submit" value="Submit">
                                                            </p>
                                                        </form>

                                                    </div><!-- .comment-respond-->
                                                </div><!-- #review_form -->
                                            </div><!-- #review_form_wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection