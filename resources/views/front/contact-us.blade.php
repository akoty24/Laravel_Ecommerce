@extends('front.layouts.app');
@section('contant')

<!--main area-->
<main id="main" class="main-site left-sidebar">
	<div class="container">
		<div class="wrap-breadcrumb">
			<ul>
				<li class="item-link"><a href="/" class="link">home</a></li>
				<li class="item-link"><span>Contact Us</span></li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">

					<div class="card-body">

						<form action="{{ route('send.contact.form') }}" method="POST" enctype="multipart/form-data">
							@csrf
							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<div class="form-group">
								<label for="title">Fname </label>
								<input type="text"  name="fname" class="form-control" placeholder="enter your frist name" style="font-size: 13px; line-height: 19px;  height: 43px; padding: 2px 20px;  max-width: 500px;   width: 100%; border: 1px solid #e6e6e6;"  >
							</div>
							<div class="form-group">
								<label for="title">Lname </label>
								<input type="text"  name="lname" class="form-control" placeholder="enter your last name" style="font-size: 13px; line-height: 19px;  height: 43px; padding: 2px 20px;  max-width: 500px;   width: 100%; border: 1px solid #e6e6e6;" >
							</div>
							<div class="form-group">
								<label for="title">Email </label>
								<input type="email"  name="email" class="form-control" placeholder="enter your email" style="font-size: 13px; line-height: 19px;  height: 43px; padding: 2px 20px;  max-width: 500px;   width: 100%; border: 1px solid #e6e6e6;" >
							</div>
							<div class="form-group">
								<label for="title">subject </label>
								<input type="text"  name="subject" class="form-control"  placeholder="enter your subject" style="font-size: 13px; line-height: 19px;  height: 43px; padding: 2px 20px;  max-width: 500px;   width: 100%; border: 1px solid #e6e6e6;" >
							</div>
							<div class="form-group">
								<label for="title">Message </label>
								<textarea name="comment" rows="3" style="max-width: 550px; " class="form-control border p-2"></textarea>
							</div>
							<button type="submit" class="btn btn-success">Submit</button>
							<br>
							<br>
							<br>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


</main>
<!--main area-->
@endsection
