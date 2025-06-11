<x-mail::message>
<div style="text-align:center; padding: 27px;">
    <img src="{{ asset('img/account-subscribed.png') }}" alt="">
</div>

# {{ ($type == 'general') ? 'Account' : ucwords($type)}} Subscription

@if($days == 3)
Your subscription will expire in the next 3 days, remember to renew your subscription via your dashboard.
@elseif($days == -14)
Your subscription expired 2 weeks ago, visit your dashboard to renew subscription to continue enjoying premium benefits.
@else
Your subscription has expired today, visit your dashboard to renew subscription to continue enjoying premium benefits.
@endif

</x-mail::message>
