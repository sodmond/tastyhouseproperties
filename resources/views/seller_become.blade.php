@extends('layouts.app', ['title' => 'Become a Vendor', 'activePage' => 'vendors'])

@section('content')
<section class="seller-poster-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-4 order-lg-2">
                <div class="poster-box">
                    <div class="poster-image">
                        <img src="{{-- asset('frontend/images/vendor-page/become-saller.svg') --}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

            <div class="col-xxl-7">
                <div class="seller-title h-100 d-flex align-items-center">
                    <div>
                        <h2>Sell Smart. Sell on Tasty House Stores...</h2>
                        <p class="mb-3">
                            We believe that selling online should be simple, fair, and truly rewarding—not complicated or filled 
                            with hidden charges. That’s why we created Tasty House Stores, a user-friendly e-commerce marketplace
                             designed specifically for independent business owners, growing brands, and passionate entrepreneurs 
                             who want to reach more customers without giving away a chunk of their profits.
                        </p>
                        <p class="mb-3">
                            At Tasty House Stores, we’ve eliminated commission fees entirely. Yes, you read that right—zero 
                            commissions. Unlike other platforms that charge a percentage on every sale you make, we believe that 
                            what you earn should stay yours. Our vendors keep 100% of their sales, allowing them to reinvest into 
                            their product, their team, or their marketing without the stress of losing margins to the platform.
                        </p>
                        <p>
                            Whether you’re just starting out or already have an established brand, our marketplace provides you 
                            with the tools, exposure, and support you need to sell efficiently and grow confidently—on your own 
                            terms.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Service Section Start -->
<section class="become-service section-b-space">
    <div class="container-fluid-lg">
        <div class="seller-title mb-5">
            <h2>Why Sell With Us?</h2>
        </div>

        <div class="row">
            <div class="col-xxl-3 col-md-3">
                <div class="service-box">
                    <img src="{{ asset('img/svg/sales-amount.svg') }}" class="svg-theme-color" alt="">
                    <div class="service-detail">
                        <h4>Zero Commission. Zero Stress.</h4>
                        <p>You deserve to keep what you earn. We don’t take a cut from your sales.</p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="service-box">
                    <img src="{{ asset('img/svg/seller.svg') }}" class="svg-theme-color" alt="">
                    <div class="service-detail">
                        <h4>Built for All Vendors</h4>
                        <p>Whether you sell fashion, gadgets, beauty products, accessories, home essentials, or more—Tasty House Stores is your marketplace.</p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="service-box">
                    <img src="{{ asset('img/svg/online-store.svg') }}" class="svg-theme-color" alt="">
                    <div class="service-detail">
                        <h4>Total Control</h4>
                        <p>Manage your products, pricing, orders, and shipping all in one place with our easy-to-use vendor dashboard.</p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-3">
                <div class="service-box">
                    <img src="{{ asset('img/svg/square-poll.svg') }}" class="svg-theme-color" alt="">
                    <div class="service-detail">
                        <h4>Market Visibility</h4>
                        <p>Reach thousands of active buyers browsing for products like yours daily.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section End -->

<!-- Business Section Start -->
<section class="business-section section-b-space">
    <div class="container-fluid-lg">
        <div class="vendor-title mb-5">
            <h5>Doing Business On TastyHouse Is Really Easy</h5>
        </div>

        <div class="business-contain">
            <div class="row">

                <div class="col-xxl-4 col-md-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>1</h2>
                            </div>
                            <div class="business-detail">
                                <h4> Register & verify your KYC</h4>
                                <p>Receive quick and hassle-free payments in your account once your orders are
                                    fulfilled. Expand your business with low interest & collateral-free loans.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>2</h2>
                            </div>
                            <div class="business-detail">
                                <h4>List Your Products & Get Support Service Provider</h4>
                                <p>Register your business for free and create a product catalogue. Sell under your
                                    own private label or sell an existing brand. Get your documentation & cataloging
                                    done with ease from our Professional Services network.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-4">
                    <div class="business-box">
                        <div>
                            <div class="business-number">
                                <h2>3</h2>
                            </div>
                            <div class="business-detail">
                                <h4>Receive orders & Schedule a pickup</h4>
                                <p>Once listed, your products will be available to millions of users.Get orders and
                                    manage your online business via our Seller Panel and Seller Zone Mobile App.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Business Section End -->

<!-- Selling Section Start -->
<section class="selling-section section-b-space">
    <div class="container-fluid-lg">
        <div class="vendor-title">
            <h5>Start Selling</h5>
            <p>Tasty house Stores- the marketplace built for vendors, designed for success. 
                We believe that selling online should be simple, fair, and rewarding. That's why we created 
                Tastyhouse Stores, a dynamic e-commerce platform where vendors can connect with customers 
                effortlessly-without the burden of commission fees. Yes, you read that right! With our 
                zero-commission model, sellers keep 100% of their earning, allowing them to focus on growth 
                and innovation.
            </p>
            <a class="btn mt-3 theme-bg-color text-white" href="{{ route('seller.register') }}">Get Started</a>
        </div>
    </div>
</section>
<!-- Selling Section End -->
@endsection