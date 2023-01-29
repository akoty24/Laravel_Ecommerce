@php
    $total = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice{{$orders -> id}}</title>
    <style>
        html,
        body {
            margin: 30px;
            padding: 30px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>
<table class="order-details">
    <thead>
    <tr>
        <th width="50%" colspan="2">
            <h2 class="text-start">Funda Ecommerce</h2>
        </th>
        <th width="50%" colspan="2" class="text-end company-data">
            <span>Invoice Id:{{$orders -> id}}</span> <br>
            <span>Date:{{$orders -> created_at}}</span> <br>
            <span>Pin code :{{$orders -> pincode}}</span> <br>
            <span>Address:{{$orders -> address}}</span> <br>
            <span>Address2:{{$orders -> address2}}</span> <br>
        </th>
    </tr>
    <tr style="color: white; font-size: 16px; text-align: center; background-color:#150b53  ">
        <th width="50%" colspan="2">Order Details</th>
        <th width="50%" colspan="2">User Details</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Order Id:</td>
        <td>{{$orders -> id}}</td>

        <td>First Name:</td>
        <td>{{$orders -> fname}}</td>
    </tr>
    <tr>
        <td>Payment Mode:</td>
        <td>{{$orders -> payment_mode}}</td>

        <td>Last Name:</td>
        <td>{{$orders -> lname}}</td>

    </tr>
    <tr>
        <td>Order Date:</td>
        <td>{{$orders -> created_at}}</td>

        <td>Email </td>
        <td>{{$orders -> email}}</td>
    </tr>
    <tr>
        <td>Order Status:</td>
        <td>{{$orders -> status()}}</td>

        <td>Phone:</td>
        <td>{{$orders -> phone}}</td>
    </tr>
    <tr>

        <td>Pin code:</td>
        <td>{{$orders -> pincode}}</td>
        <td>Address:</td>
        <td>{{$orders -> address}}</td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr >
        <th class="no-border text-start heading" colspan="5">
            Order Items
        </th>
    </tr>
    <tr style="color: white; font-size: 16px; text-align: center; background-color:#150b53  ">
        <th>Id</th>
        <th>product name</th>
        <th>price</th>
        <th>quantity</th>
        <th>Grand Total</th>
    </tr>
    </thead>
    <tbody>

    @isset($orders)
        @foreach($orders->items as $order)
            @if($order->products->quantity >= $order->quantity)
                @php
                    $sub = $order->products->price * $order->quantity ;
                     $total += $sub;
                @endphp
            @endif
            <tr>
                <td>{{$order -> id}}</td>
                <td>{{$order ->products->name}}</td>
                <td>{{$order ->products->price}}</td>
                <td>{{$order -> quantity}}</td>
                <td>{{$sub}}</td>
            </tr>

        @endforeach
    @endisset
    <tr>
        <td colspan="4" class="total-heading" style="color: black; font-size: 25px; text-align: center; " >Total Amount  :</td>
        <td colspan="1" class="total-heading" style="color: white; font-size: 16px; text-align: center; background-color:red    " > ${{$orders -> total_price}}</td>
    </tr>
    </tbody>
</table>

<br>
<p class="text-center">
    Thank your for shopping with Funda of Web IT
</p>

</body>
</html>