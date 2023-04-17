@extends('front.layouts.app');
@section('style')
    <title>Laravel 9 - Stripe Payment Gateway Integration Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
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
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>check out</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('place.order')}}" method="POST" name="frm-billing">
                        @csrf
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <p class="row-in-form">
                            <label for="fname">first name<span>*</span></label>
                            <input type="text" name="fname" id="fname" class="form-control fname"
                                   value="{{Auth::user()->name}}" placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="lname">last name<span>*</span></label>
                            <input type="text" name="lname" id="lname" class="form-control lname"
                                   value="{{Auth::user()->lname}}" placeholder="Your last name">
                            <span class="text-danger lname"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control email"
                                   value="{{Auth::user()->email}}" placeholder="Type your email">
                            <span class="text-danger email"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input type="number" name="phone" id="phone" class="form-control phone"
                                   value="{{Auth::user()->phone}}" placeholder="10 digits format">
                            <span class="text-danger phone"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address:</label>
                            <input type="text" name="address" id="address" class="form-control address"
                                   value="{{Auth::user()->address}}" placeholder="Street at apartment number">
                            <span class="text-danger address"></span>

                        </p>
                        <p class="row-in-form">
                            <label for="add">Address2:</label>
                            <input type="text" name="address2" id="address2" class="form-control address2"
                                   value="{{Auth::user()->address2}}" placeholder="Street at apartment number">
                            <span class="text-danger address2"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input type="text" name="country" id="country" class="form-control country"
                                   value="{{Auth::user()->country}}" placeholder="United States">
                            <span class="text-danger country"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input type="text" name="city" id="city" class="form-control city"
                                   value="{{Auth::user()->city}}" placeholder="City name">
                            <span class="text-danger city"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="pincode">pincode:</label>
                            <input type="number" name="pincode" id="pincode" class="form-control pincode"
                                   value="{{Auth::user()->pincode}}" placeholder="Your pin code">
                            <span class="text-danger pincode"></span>

                        </p>
                        @if($cartitems->count()>0)
                            @foreach($cartitems as $item)
                                @if($item->products->quantity >= $item->quantity)
                                    @php
                                        $sub = $item->products->price * $item->quantity ;
                                         $total += $sub;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        <div class="summary summary-checkout">
                            <div class="summary-item payment-method">
                                <h4 class="title-box">Payment Method</h4>
                                <p class="summary-info grand-total"><span>Grand Total</span> <span
                                            class="grand-total-price" style="color: red">${{$total}}</span></p>
                                <div class="choose-payment-methods">
                                    <label class="payment-method">
                                        <input name="payment-method" id="payment-method-Cash On Delivery"
                                               value="Cash On Delivery" type="radio">
                                        <span>Cash On Delivery</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="payment-method" id="payment-method-Credit Card" value="card"
                                               type="radio">
                                        <span>Credit Card</span>
                                    </label>
                                    <hr>
                                    @error('payment-method')
                                    <span style="color:red;" class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($cartitems->count()>0)
                                        <button type="submit" id="cash_submit" class="btn btn-success w-100"
                                                style="background-color: darkgreen">order now
                                        </button>
                                    @else
                                        <a href="{{route('show.cart')}}" type="button" class="btn btn-success w-100"
                                           style="background-color: darkgreen">Place order now</a>
                        @endif
                       </form>
                </div>
            </div>
            <div class="summary-item shipping-method">
                <h4 class="title-box">Cart Items</h4>
                @if($cartitems->count()>0)
                    @foreach($cartitems as $item)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">photo</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">remove</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="col">
                                    <figure><img width="90px" height="90px"
                                                 src="{{url('front/photos/product/'.$item->products->photo)}}"
                                                 alt="{{$item->products->name}}"></figure>
                                </th>
                                <td>
                                    <a class="link-to-product"
                                       href="{{route('product.detail',$item->product_id)}}">{{$item->products->name}}</a>
                                </td>
                                <td>
                                    <p class="price">${{$item->products->price}}</p>
                                </td>
                                <td>
                                    @if($item->products->quantity >= $item->quantity)
                                        @php
                                            $sub = $item->products->price * $item->quantity ;
                                             $total += $sub;
                                        @endphp
                                        <p class="text-center">{{$item->quantity}}</p>
                                    @else
                                        <h2>out of stock</h2>
                                    @endif

                                </td>
                                <td>
                                    <div class="text"><a
                                                href="{{route('remove.from.cart',$item->product_id)}}"><i
                                                    class="fa fa-times-circle"></i></a></div>

                                </td>
                            </tr>
                            </tbody>
                        </table>

                    @endforeach
                @else
                    <h1 class="text-center">No Item In Cart</h1>
                @endif
            </div>

        </div>

 </main>
    <!--main area-->
@endsection
@section('custom-js')

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection

