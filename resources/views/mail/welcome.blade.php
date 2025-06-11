<x-mail::message>
<div style="text-align:center; padding-bottom: 20px;">
    <img src="{{ asset('img/welcome.jpg') }}" alt="" style="width:100%;">
</div>

# Welcome To TastyHouse

Hi {{ $fname }},

Welcome to the TastyHouse community! We're thrilled to have you join us. Whether you're here 
to discover amazing products/services or to showcase your own, you've come to the right place.

@if(auth('seller')->check())
<strong>Reach a wider audience.</strong> Showcase your products/services to a large and engaged customer base.

<strong>Manage your business with ease.</strong> Our intuitive tools make it simple to list products, track orders, and communicate with customers.

<strong>Grow your brand and increase sales.</strong> We provide the platform and resources you need to succeed.
@else
<strong>Discover a world of Household Items.</strong> Browse our diverse selection and find exactly what you're looking for.

<strong>Enjoy a seamless shopping experience.</strong> We've designed our platform to be easy to use and secure.

<strong>Connect with trusted vendors.</strong> We've carefully vetted our sellers to ensure quality and reliability.
@endif

</x-mail::message>
