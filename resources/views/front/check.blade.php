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
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>login</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    <form action="{{route('checkout')}}" method="POST" name="frm-billing">
                        @csrf
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <p class="row-in-form">
                            <label for="fname">first name<span>*</span></label>
                            <input type="text" name="fname" id="fname" required class="form-control fname"
                                   value="{{Auth::user()->name}}" placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="lname">last name<span>*</span></label>
                            <input type="text" name="lname" id="lname" required class="form-control lname"
                                   value="{{Auth::user()->lname}}" placeholder="Your last name">
                            <span class="text-danger lname" ></span>
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required class="form-control email"
                                   value="{{Auth::user()->email}}" placeholder="Type your email">
                            <span class="text-danger email" ></span>
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input type="number" name="phone" id="phone" required class="form-control phone"
                                   value="{{Auth::user()->phone}}" placeholder="10 digits format">
                            <span class="text-danger phone"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address:</label>
                            <input type="text" name="address" id="address" required class="form-control address" value="{{Auth::user()->address}}" placeholder="Street at apartment number">
                            <span class="text-danger address" ></span>

                        </p>
                        <p class="row-in-form">
                            <label for="add">Address2:</label>
                            <input type="text" name="address2" id="address2" required class="form-control address2"
                                   value="{{Auth::user()->address2}}" placeholder="Street at apartment number">
                            <span class="text-danger address2" ></span>
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input type="text" name="country" id="country" required class="form-control country"
                                   value="{{Auth::user()->country}}" placeholder="United States">
                            <span class="text-danger country" ></span>
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input type="text" name="city" id="city" required class="form-control city"
                                   value="{{Auth::user()->city}}" placeholder="City name">
                            <span class="text-danger city"></span>
                        </p>
                        <p class="row-in-form">
                            <label for="pincode">pincode:</label>
                            <input type="number" name="pincode" id="pincode" required class="form-control pincode" value="{{Auth::user()->pincode}}" placeholder="Your pin code">
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

                                <div class="wrap-address-billing">
                                    <p class="row-in-form">
                                        <label for="card-no">Card Number</label>
                                        <input type="text" name="cart_no" placeholder="card number">

                                    </p>
                                    <p class="row-in-form">
                                        <label for="exp-month">Expiry Month</label>
                                        <input type="text" name="exp_month" placeholder="mm">

                                    </p>
                                    <p class="row-in-form">
                                        <label for="exp-year">Expiry Year</label>
                                        <input type="text" name="exp_year" placeholder="card number">

                                    </p>
                                    <p class="row-in-form">
                                        <label for="cvc">CVC</label>
                                        <input type="password" name="cvc" placeholder="cvc" style="font-size: 13px; line-height: 19px; display: inline-block; height: 43px; padding: 2px 20px;  max-width: 300px;   width: 100%; border: 1px solid #e6e6e6;">
                                    </p>
                                </div>

                                <div class="choose-payment-methods">
                                    <label class="payment-method">
                                        <input name="payment-method" id="payment-method-Cash On Delivery" value="Cash On Delivery" type="radio">
                                        <span>Cash On Delivery</span>
                                        <span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="payment-method" id="payment-method-Credit Card" value="card" type="radio">
                                        <span>Credit Card</span>
                                        <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                                    </label>

                                    {{--               <label class="payment-method">
                                        <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                                        <span>Paypal</span>
                                        <span class="payment-desc">You can pay with your credit</span>
                                        <span class="payment-desc">card if you don't have a paypal account</span>
                                    </label>
--}}
                                </div>
                                <p class="summary-info grand-total"><span>Grand Total</span> <span
                                            class="grand-total-price">${{$total}}</span></p>
                                <input type="hidden" name="payment-mode" value="COD">
                                @if($cartitems->count()>0)
                                    <button type="submit" class="btn btn-success w-100" style="background-color: darkgreen">order now pay on delivery</button>
                                    <hr>
                                    <div id="paypal-button-container"></div>
                                @else
                                    <a href="{{route('showcart')}}" type="button" class="btn btn-success w-100" style="background-color: darkgreen">Place order now</a>
                                @endif
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
                                                       href="{{route('detail_product',$item->product_id)}}">{{$item->products->name}}</a>
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
                                                                href="{{route('removecart',$item->product_id)}}"><i
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

                    </form>
                </div>
            </div><!--end main content area-->
        </div><!--end container-->
    </main>
    <!--main area-->
@endsection
@section('custom-js')
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AZpPap60KWgyjv9n7DjrMBDaR6GuF0b1I-juurbbBNhYwZXQvkwl3WVOA-MQfPQanYXlDkxHq-C1YN0-&currency=USD"></script>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{$total}}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection