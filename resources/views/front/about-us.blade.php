@extends('front.layouts.app');
@section('contant');
@include('admin.includes.alerts.alert')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.sweet_alert')
@include('admin.includes.alerts.error')
	<!--main area-->
	<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>About us</span></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<!-- <div class="main-content-area"> -->
				<div class="our-team-info">
					<h4 class="title-box" style="font-size: 30px">Our Teams Are Here To Help</h4>
					<p class="title-box" style="font-size: 15px; color: grey; text-transform: lowercase;">Spitfire Inbound’s Shiran Sugerman adds their About page to this list of About Us page examples. Sugerman writes, “The ‘About us’ section of your website is the one page on your website where you can focus on yourself as a brand.</p>
					<hr>
					<br>
					<br>

					<div class="our-staff">
						<div 
							class="slide-carousel owl-carousel style-nav-1 equal-container" 
							data-items="5" 
							data-loop="false" 
							data-nav="true" 
							data-dots="false"
							data-margin="30"
							data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"4"}}' >
						@if($team_members)
							@foreach($team_members as $member)
							<div class="team-member equal-elem">
								<div class="media">
									<a href="#" title="{{$member->name}}">
										<figure><img src="{{url('front/photos/member/'.$member->photo)}}" alt="{{$member->name}}"></figure>
									</a>
								</div>
								<div class="info">
									<b class="name">{{$member->name}}</b>
									<span class="title">{{$member->title}}</span>
									<p class="desc">{{$member->description}}</p>
									<a href="#" class="btn btn-danger" style="float: right">{{$member->btn_text}}</a>
								</div>
							</div>
							@endforeach
								@endif
						</div>
					</div>
				</div>
			<!-- </div> -->
		</div><!--end container-->
	</main>
	<!--main area-->
@endsection