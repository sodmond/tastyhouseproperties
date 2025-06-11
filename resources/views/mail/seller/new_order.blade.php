<x-mail::message>
<div style="text-align:center; padding: 27px;">
    <img src="{{ asset('img/order-success-poster.png') }}" alt="">
</div>

# New Order

A user just placed on order on your product(s), see the order summary below.

<x-mail::panel>
<strong>Order Summary</strong>
<?php
$productsName = json_decode($order->product_name);
$quantity = json_decode($order->quantity);
?>
<table style="width:100%;">
    <tbody>
        <tr>
            <td style="">
                <ul>
                    @for($i=0; $i < count($quantity); $i++)
                        <li style="text-align:left; padding-bottom:10px;">
                            {{ $productsName[$i] }} x{{ $quantity[$i] }}
                        </li>
                    @endfor
                </ul>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dashed #333; text-align:left; padding-bottom:15px;">
                <strong>Delivery Option:</strong> {{ ucwords($order->delivery_option) }}
                @if($order->delivery_option == 'home')
                    <div><small>Address: {{ $order->delivery_address }}</small></div>
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align:left;">
                <strong>Total Amount:</strong> {{ $currency.number_format($order->amount, 2) }}
            </td>
        </tr>
    </tbody>
</table>
</x-mail::panel>

Click the below to chat with the user;

<x-mail::button :url="$url">
Open Chat
</x-mail::button>

<p>Find a delivery rider on TastyHouse Stores, <a href="{{ config('app.url').'/shop/category/374/delivery-service' }}"><u>click here</u></a></p>

</x-mail::message>
