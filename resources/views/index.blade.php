@extends('front.layouts.app');
@section('contant');
<main id="main">
	<div class="container">
		<!--MAIN SLIDE-->
		<div class="wrap-main-slide">
			<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
				@isset($Slider)
				@foreach($Slider as $Sliders)
					<div class="item-slide">
						<img style="width: 100% ; height: 70%" src="{{ url('front/photos/slider/'.$Sliders->photo)}}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title"><b>{{$Sliders->name}}</b> <br></h2>
							<span class="subtitle">{{$Sliders->subdescription}}</span>
							<p class="sale-info">Only Price.<span class="price">${{$Sliders->price}}</span></p>
							<a href="{{$Sliders->link}}" class="btn-link">Shop Now</a>
						</div>
					</div>
				@endforeach
				@endisset
			</div>
		</div>
		<!--BANNER-->
		<div class="wrap-show-advance-info-box style-1">
			<h3 class="title-box">Product Categories</h3>
			<div class="wrap-top-banner">
				@isset($banners)
					@foreach($banners as $banner)
				<a href="#" class="link-banner banner-effect-2">
					<figure><img src="{{ url('front/photos/banner/'.$banner->photo1)}}" width="1170" height="240" alt=""></figure>
				</a>
					@endforeach
				@endisset
			</div>
			<div class="wrap-products">
				<div class="wrap-product-tab tab-style-1">
					<div class="tab-control">
						@isset($categories)
							@foreach($categories as $category)
								<a href="{{route('index',['category'=>$category->id])}}"  data-toggle="modal"  class="tab-control-item category">{{$category->name}}</a>
							@endforeach
						@endisset
					</div>
					<div class="tab-contents">
						<div class="tab-content-item active" id="fashion_1a">
							<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
							@isset($products)
								@foreach($products as $product)
								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="{{route('product.detail',$product->id)}}" title="{{$product->name}}">
											<figure><img src="{{ url('front/photos/product/'.$product->photo)}}" alt="{{$product->name}}"></figure>
										</a>
										<div class="group-flash">
											<a href="{{route('product.detail',$product->id)}}" class="function-link">quick view</a>
										</div>
										<div class="wrap-btn">
											<a href="{{route('product.detail',$product->id)}}" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="#" class="product-name"><span>{{$product->description}}</span></a>
										<div class="wrap-price"><span class="product-price">{{$product->price}}</span></div>
									</div>
								</div>
								@endforeach
								@endisset

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Latest Products-->
		<div class="wrap-show-advance-info-box style-1">
			<h3 class="title-box">Latest Products</h3>
			<div class="wrap-top-banner">
				@isset($banners)
					@foreach($banners as $banner)
						<a href="{{route('shop')}}" class="link-banner banner-effect-2">
							<figure><img src="{{ url('front/photos/banner/'.$banner->photo2)}}" width="1170" height="240" alt=""></figure>
						</a>
					@endforeach
				@endisset
			</div>
			<div class="wrap-products">
				<div class="wrap-product-tab tab-style-1">
					<div class="tab-contents">
						<div class="tab-content-item active" id="digital_1a">
							<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
								@isset($productsss)
								@foreach($productsss as $product)
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="" title="{{$product->name}}">
												<figure><img src="{{ url('front/photos/product/'.$product->photo)}}" alt="{{$product->name}}"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="{{route('shop')}}" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{$product->name}}</span></a>
											<div class="wrap-price"><span class="product-price">{{$product->price}}</span></div>
										</div>
									</div>
								@endforeach
								@endisset
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</main>
@endsection