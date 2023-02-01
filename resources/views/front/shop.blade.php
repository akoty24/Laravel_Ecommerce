@extends('front.layouts.app');
@section('contant')
	@include('admin.includes.alerts.alert')
	@include('admin.includes.alerts.success')
	@include('admin.includes.alerts.sweet_alert')
	@include('admin.includes.alerts.error')

	<!--main area-->
	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>{{$categoryName}}</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-shop-control">
						@if($categoryName)
							<h1 class="shop-title">{{$categoryName}}</h1>
						@else
							<h1 class="shop-title">all products</h1>
						@endif
{{--						<div class="wrap-right">

							<div class="sort-item orderby ">
								<select name="orderby" class="use-chosen">
									<option value="menu_order" selected="selected">Default sorting</option>
									<option value="date">Sort by newness</option>
									<option value="price">Sort by price: low to high</option>
									<option value="price-desc">Sort by price: high to low</option>
								</select>
							</div>

							<div class="sort-item product-per-page">
								<select name="post-per-page" class="use-chosen">
									<option value="12" selected="selected">12 per page</option>
									<option value="16">16 per page</option>
									<option value="18">18 per page</option>
									<option value="21">21 per page</option>
									<option value="24">24 per page</option>
									<option value="30">30 per page</option>
									<option value="32">32 per page</option>
								</select>
							</div>

													<div class="change-display-mode">
														<a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
														<a href="{{route('list')}}" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
													</div>

					</div>--}}
					</div><!--end wrap shop control-->

					<div class="row">
						<ul class="product-list grid-products equal-container">

							@foreach($products as $product)
								<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
									<div class="product product-style-3 equal-elem ">
										<div class="product-thumnail">
											@if($product->quantity>1)
												<a href="{{route('product.detail',$product->id)}}"
												   title="{{$product->description}}">
													<figure><img src="{{url('front/photos/product/'.$product->photo)}}"
																 alt="{{$product->description}}"></figure>
													@else
														<a href="{{route('product.detail',$product->id)}}"
														   title="{{$product->description}}">
															<figure><img
																		src="{{url('front/photos/product/'.$product->photo)}}"
																		alt="{{$product->description}}"></figure>
															<div class="group-flash">
																<span class="flash-item new-label"
																	  style="background-color: red;font-size: 7px">out of stock</span>
															</div>
														</a>
											@endif
										</div>
										<div class="product-info">
											<a href="{{route('product.detail',$product->id)}}"
											   class="product-name"><span>{{$product->name}}</span></a>
											<style>
												.color-gray {
													color: #cacaca !important;
												}
											</style>
											@if(App\models\Review::where('product_id',$product->id)->first())
												@php
													$reviews=App\models\Review::where('product_id',$product->id)->get();
                                                    $rating=App\models\Review::where('product_id',$product->id)->avg('rating');
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
												@if($product->reviews->count()>0)
													<a href=#review"
													   class="count-review">. {{$product->reviews->count()}}
														review(s)</a>
												@else
													<span class="text-danger">no review</span>
												@endif
											</div>

											<span>{{$product->description}}</span>
											<div class="wrap-price"><span
														class="product-price">${{$product->price}}</span></div>
											<form action="{{route('add.to.cart',$product->id)}}" method="POST">
												@csrf
												<div class="quantity">
													<span>Quantity:</span>
												</div>
												<div class="quantity-input">
													<input type="number" class="form-control" style="width:70px"
														   name="quantity" value="1" min="1"
														   data-max="{{$product->quantity}}" pattern="[0-9]*">
												</div>
												<br>
												@if($product->quantity>1)
													<input href="" class="btn add-to-cart" value="Add To Cart"
														   type="submit">

												@else
													<input href="" class="btn add-to-cart" value="Add To Cart"
														   type="submit" disabled>
												@endif
											</form>
										</div>
									</div>
								</li>
							@endforeach

						</ul>

					</div>

					<div class="wrap-pagination-info">
						{{$products->links()}}
					</div>
				</div><!--end main products area-->


				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget mercado-widget categories-widget">
						<h2 class="widget-title">All Categories</h2>
						<div class="widget-content">
							<ul class="list-category">
								@foreach($categories as $category)
									<li class="category-item">
										<a href="?category={{$category->id}}" class="cate-link">{{$category->name}}</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div><!-- Categories widget-->

					{{--				<div class="widget mercado-widget filter-widget brand-widget">
                                        <h2 class="widget-title">Brand</h2>
                                        <div class="widget-content">
                                            <ul class="list-style vertical-list list-limited" data-show="6">
                                                <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                                                <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                                                <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                                                <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                                                <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                                                <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- brand widget-->--}}
					<!-- Price-->
					{{--	<div class="widget mercado-widget filter-widget price-filter">
                                        <h2 class="widget-title">Price</h2>
                                        <div class="widget-content">
                                            <div id="slider-range"></div>
                                            <p>
                                                <label for="amount">Price:</label>
                                                <input type="text" id="amount" readonly>
                                                <button class="filter-submit">Filter</button>
                                            </p>
                                        </div>
                                    </div>--}}
					<!-- Color -->
					{{--	<div class="widget mercado-widget filter-widget">
                                        <h2 class="widget-title">Color</h2>
                                        <div class="widget-content">
                                            <ul class="list-style vertical-list has-count-index">
                                                <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                                                <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                                            </ul>
                                        </div>
                                    </div>--}}
					<!-- Size -->
					{{--<div class="widget mercado-widget filter-widget">
                                        <h2 class="widget-title">Size</h2>
                                        <div class="widget-content">
                                            <ul class="list-style inline-round ">
                                                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                                                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                                            </ul>
                                            <div>
                                                <br>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                        </div>
                                    </div>--}}
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
												   class="product-name"><span>{{$popular_product->name}}</span></a>
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
													@if($popular_product->reviews->count()>0)
														<a href=#review"
														   class="count-review">. {{$popular_product->reviews->count()}}
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
					</div><!-- brand widget-->

				</div><!--end sitebar-->

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->

@endsection