<x-mail::message>
<div style="text-align:center; padding: 27px;">
    <img src="{{ asset('img/account-subscribed.png') }}" alt="">
</div>

# Account Subscription

Your subscription payment was successful! Thank you for subscribing. 
You now have full access to all the benefits of your chosen plan. 
We're excited to have you on board!

See you subscription details below;

<x-mail::panel>
<p><strong>Package:</strong> <br>{{ ucwords($subscription->package->title) }}</p>
<p><strong>Type:</strong> <br>{{ ucwords($subscription->package->type) }}</p>
<p><strong>Start Date:</strong> <br>{{ date('M d, Y', strtotime($subscription->start_date)) }}</p>
<p><strong>End Date:</strong> <br>{{ date('M d, Y', strtotime($subscription->end_date)) }}</p>
<p><strong>Payment Gateway:</strong> <br>{{ ucwords($subscription->gateway) }}</p>
<p><strong>Payment Reference:</strong> <br>{{ ucwords($subscription->reference) }}</p>
</x-mail::panel>


</x-mail::message>
