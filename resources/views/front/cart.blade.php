@extends('front.layouts.app');
@section('contant')
	@include('admin.includes.alerts.alert')
	@include('admin.includes.alerts.success')
	@include('admin.includes.alerts.sweet_alert')
	@include('admin.includes.alerts.error')

	@php
		$total = 0;
	@endphp
	<!--main area-->
	<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
				<div class="wrap-iten-in-cart cart-items">
					<h3 class="box-title">Products</h3>
					@if($cartitems->count()>0)
						@foreach($cartitems as $item)
							<ul class="products-cart product-data">
								<li class="pr-cart-item">
									<div class="product-image">
										<a class="link-to-product" href="{{route('detail_product',$item->product_id)}}">
										<figure >
											<img style="width: 50%;" src="{{url('front/photos/product/'.$item->products->photo)}}" alt="{{$item->products->name}}">
										</figure>
										</a>
									</div>
									<div class="product-name"  style="text-align: center">
										<a class="link-to-product" href="{{route('detail_product',$item->product_id)}}">
											<h3 class="box-title" style="text-align: center">Product Name</h3>
											<span style="text-align: center">{{$item->products->name}}</span>
										</a>
									</div>
									<div class="price-field produtc-price" style="text-align: center">
										<p class="price">
										<h3 class="box-title" style="text-align: center">Product Price</h3>${{$item->products->price}}</p></div>
									<div class="quantity"  style="text-align: center">
										<input type="hidden" class="product_id" name="product_id" value="{{$item->product_id}}">
									@if($item->products->quantity >= $item->quantity)
											<label for="Quantity" style="font-size: 14px;">Quantity</label>
										     	<div class="input-group text-center mb-3" style="width: 90px">
													<input  style="margin-left: 65%" type="number" min="1" name="quantity" class="form-control change-quantity qty-input text-center" id="qty-input" value="{{$item->quantity}}" >
												</div>
									@php
										$sub = $item->products->price * $item->quantity ;
                                         $total += $sub;
									@endphp
										@else
											<h2>out of stock</h2>
										@endif
									</div>
									<div class="price-field sub-total" style="text-align: center">
											<p class="price"><h3 class="box-title" style="text-align: center">Sub Price</h3>${{$sub}}</p>
										</div>
									<div class="delete">
										<a href="{{route('removecart',$item->product_id)}}"
										   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> <i
													class="fa fa-times-circle"></i></a>
									</div>
								</li>
							</ul>
						@endforeach
						<br>
						<div class="summary">
							<div class="order-summary">
								<p class="summary-info total-info "><span class="title" style="font-size: 20px">Total:</span>
									<b class="index">${{$total}}
									</b>
								</p>
							</div>
							<div class="checkout-info">
								<a class="btn btn-checkout" href="{{route('check')}}">Check out</a>
								<a class="link-to-shop" href="{{route('shop')}}">Continue Shopping<i
											class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</a>
							</div>
							{{--								<div class="update-clear">
                                                                <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
                                                                <a class="btn btn-update" href="#">Update Shopping Cart</a>
                                                            </div>--}}
						</div>
					@else
						<h1 class="text-center">No Item In Cart</h1>
						<div class="checkout-info" style="float: right">
							<a class="btn btn-primary" href="{{route('shop')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
							</a>
						</div>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					@endif
				</div>
			</div><!--end main content area-->
		</div><!--end container-->
	</main>
	<!--main area-->

@endsection
@section('custom-js')
	<script>
		loadCart();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		function loadCart() {
			$.ajax({
				method: "GET",
				url: "/load-cart-data",
				success: function (response) {
					$(".cart-count").html("");
					$(".cart-count").html(response.count);
				},
			});
		}
		// $(".change-quantity").change(function (e) {
		$(document).on("change", ".change-quantity", function (e) {
			e.preventDefault();
			var product_id = $(this).closest(".product-data").find(".product_id").val();
			var quantity = $(this).closest(".product-data").find(".qty-input").val();
			$.ajax({
				method: "POST",
				url: "/update_cart_item",
				data: {
					product_id: product_id,
					quantity: quantity,
				},
				success: function (response) {
					// window.location.reload();
					$(".cart-items").load(location.href + ".cart-items");
					// Swal.fire(response.status);
				},
			});
		});

	</script>
@endsection