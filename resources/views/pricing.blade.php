@extends('layouts.app', ['title' => 'Subscription Pricing', 'activePage' => 'tandc'])

@section('content')
<style>
    div.fresh-contain ul li{
        line-height:28px;
        padding-left: 10px;
    }
    div.fresh-contain ul li::before{
        content: "\2022";
        font-size: inherit;
        margin-right: 5px;
    }
</style>
<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-xs">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-12 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h2>Tastyhouse Subscription Price Plan</h2>
                        </div>

                        <div>
                            <h4 class="mb-2">Basic Plan 2000 Naira Monthly</h4>
                            <p>Benefits</p>
                            <ul class="list-group">
                                <li>Account Activation</li>
                                <li>Unlimited Menu, Products and Service Listings</li>
                                <li>24/7 Customer Support</li>
                            </ul>
                            <p>&nbsp;</p>
                        </div>
                        <div>
                            <h4 class="mb-2">Prime Membership 5000 Naira Monthly</h4>
                            <p>Great Benefits</p>
                            <ul class="list-group">
                                <li><strong>QR Code & Personalised Page Link:</strong> Generate and share your unique QR Code with customers for easy access to your page.</li>
                                <li><strong>Priority Listings:</strong> Ensure selected listed items appear at the top of the appropriate categories, making it easier for customers to find you.</li>
                                <li><strong>Exclusive Visibility:</strong> Increase visibility by promoting your page across our social media platforms with exclusive promotional content and spotlight opportunities to attract more buyers.</li>
                                <li><strong>Dedicated Support:</strong> Receive priority customer service to help you succeed on TastyHouse.</li>
                            </ul>
                            <p>&nbsp;</p>
                        </div>

                        <div class="review-title">
                            <h2>Subscription Terms and Conditions</h2>
                            <p>Tastyhouse subscriptions are billed monthly or quarterly, semi-annually, or yearly</p>
                        </div>
                        <div>
                            <h4 class="mb-2">Cancellation and Refund</h4>
                            <p>Please note; once your account subscription is activated there will be no refunds throughout the activation period unless it expires without a repeated subscription.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">Data Retention</h4>
                            <p>Users retain data once the subscription expires which means you can still log into your account but you will not be able to access all your listed products and services to edit or upload new items. Customers will not be able to contact you or send a direct message without a valid subscription, we often send a reminder email two weeks and a few days before your subscription expires.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">Pricing changes</h4>
                            <p>Prices may vary, changes are notifi ed in advance, such as off ers, free trials.</p>
                            <p>Contact us if you need more information on any of our products and services.
                                <br>Email:<br>
                                <ul class="list-group">
                                    <li><a href="mailto:info@tastyhouseclub.com">Info@tastyhouseclub.com</a></li>
                                    <li><a href="mailto:info@tastyhousestores.com">Info@tastyhousestores.com</a></li>
                                    <li><a href="mailto:info@tastyhouseproperties.com">Info@tastyhouseproperties.com</a></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection