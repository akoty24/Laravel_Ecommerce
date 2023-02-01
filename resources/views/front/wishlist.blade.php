@extends('front.layouts.app');
@section('contant')
	@include('admin.includes.alerts.alert')
	@include('admin.includes.alerts.success')
	@include('admin.includes.alerts.sweet_alert')
	@include('admin.includes.alerts.error')
	<section class="shopping-cart spad">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>wishlist</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-12">
					@if($wishlistitems->count()<1)
						<h1 class="text-center">No Item In Wishlist</h1>
						<br><br><br><br><br><br><br><br><br><br><br>
					@else
						<div class="cart-table">
							<table>
								<thead>
								<tr>
									<th>Image</th>
									<th class="p-name">Product Name</th>
									<th>Price</th>
									<th>add to cart</th>
									<th><i style="font-size: 20px;line-height: 24px; color: #888888; outline: none;" class="fa fa-times-circle"></i></th>
								</tr>
								</thead>
								<tbody>
								@foreach($wishlistitems as $item)
									<tr>
										<td class="cart-pic first-row">
											<a class="link-to-product" href="{{route('product.detail',$item->product_id)}}">
											<img width="50%"src="{{url('front/photos/product/'.$item->products->photo)}}" alt="{{$item->products->name}}">
											</a>
										</td>

										<td class="cart-title first-row">
											<a class="link-to-product" href="{{route('product.detail',$item->product_id)}}">{{$item->products->name}}</a>
										</td>
										<td class="p-price first-row">{{$item->products->price}}</td>
										<td class="close-td first-row remove-row">
											<form action="{{route('add.to.cart',$item->products->id)}}" method="POST">
												@csrf
													<div class="quantity-input">
														<input type="hidden" class="form-control" min="1" style="width:70px" name="quantity" value="1" data-max="120" pattern="[0-9]*">
													</div>
													<input href="" class="btn add-to-cart" value="Add To Cart" type="submit">
											</form>
										</td>
										<td class="close-td first-row remove-row">
											<a href="{{route('remove.from.wishlist',$item->product_id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
												<i style="font-size: 20px;line-height: 24px; color: #888888; outline: none;" class="fa fa-times-circle"></i>
											</a>
										</td>
									</tr>
								@endforeach
								@endif
								</tbody>
							</table>

						</div>
				</div>
			</div>
		</div>
	</section>

@endsection