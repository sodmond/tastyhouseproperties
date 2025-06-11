<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'About Us', 'activePage' => 'about'])

@section('content')
<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-6 col-12">
                <div class="row g-sm-4 g-2">
                    <div class="col-6">
                        <div class="fresh-image-2">
                            <div>
                                <img src="{{ asset('img/about-img-1.jpg') }}"
                                    class="bg-img blur-up lazyload" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="fresh-image">
                            <div>
                                <img src="{{ asset('img/about-img-2.jpg') }}"
                                    class="bg-img blur-up lazyload" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h4>About Us</h4>
                            <h2>Welcome To Tasty House Stores And Services Ltd COMPANY REGISTRATION NO. 8297143</h2>
                            <h3 class="mb-4">The Marketplace Built For Catering Club, Multi-Vendors and Services. Designed For Success.</h3>
                        </div>

                        <div class="delivery-list">
                            <p class="text-content">We believe that selling online should be simple, fair, and rewarding. 
                                That's why we created Tastyhouse Stores, a dynamic e-commerce platform where vendors can connect 
                                with customers effortlessly-without the burden of commission fees. Yes, you read that right! With 
                                our zero-commission model, sellers keep 100% of their earning, allowing them to focus on growth and 
                                innovation.</p>
                            <p class="text-content">Whether you're an entrepreneur launching a new brand or an established business 
                                looking for a wider audience, Tastyhouse Stores gives you the tools and visibility you need to succeed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fresh Vegetable Section End -->

<!-- Review Section Start -->
<section class="client-section section-lg-space">
    <div class="container-fluid">
        <div class="about-us-title text-center">
            <h4 class="text-content">Core Values</h4>
            <h2 class="center">What we stand for</h2>
        </div>
        <div class="slider-3_1 product-wrapper">
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-hand-rock"></i></span>
                    </div>
                    <h4>Empowerment </h4>
                    <p>We give vendors full control over their success with an affordable commission - free marketplace.</p>
                </div>
            </div>
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-lightbulb"></i></span>
                    </div>
                    <h4>Innovation</h4>
                    <p>We embrace technology to create flawless and efficient shopping experiences.</p>
                </div>
            </div>
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-shield"></i></span>
                    </div>
                    <h4>Fairness & Transparency</h4>
                    <p>With a simple N2,000 Naira Monthly Subscription and N5,000 Prime Subscription, vendors enjoy full access to our platform without hidden fees.</p>
                </div>
            </div>
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-chart-line"></i></span>
                    </div>
                    <h4>Growth & Visibility</h4>
                    <p>For vendors who want even more exposure, our optional Prime service offers premium visibility to reach a wider audience.</p>
                </div>
            </div>
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-headset"></i></span>
                    </div>
                    <h4>Customer-Centric</h4>
                    <p>We prioritize quality, convenience, and satisfaction for both vendors and buyers.</p>
                </div>
            </div>
            <div>
                <div class="clint-contain text-center">
                    <div class="text-center mb-3">
                        <span class="fs-2"><i class="fas fa-hands"></i></span>
                    </div>
                    <h4>Integrity</h4>
                    <p>We operate with transparency, trust, and a commitment to ethical business practices.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Review Section End -->

<!-- Blog Section Start -->
<section class="section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-md-6 p-4">
                <div class="about-us-title text-center">
                    <h4 class="text-content">Our</h4>
                    <h2 class="center">Mission Statement</h2>
                </div>
                <p class="fs-6 text-center" style="line-height:26px;">
                    At Tasty House Stores, our mission is to empower vendors by providing a dynamic, user-friendly 
                    marketplace that connects businesses with customers seamlessly-all with a zero-commission model 
                    that ensures sellers keep 100% of their earnings. We strive to create a thriving digital 
                    ecosystem where entrepreneurs can grow, innovate, and succeed. By prioritizing quality, 
                    convenience, and customer satisfaction, we aim to redefine the online shopping experience for 
                    both buyers and vendors.</p>
            </div>
            <div class="col-md-6 p-4">
                <div class="about-us-title text-center">
                    <h4 class="text-content">Our</h4>
                    <h2 class="center">Vision Statement</h2>
                </div>
                <p class="fs-6 text-center" style="line-height:26px;">
                    To be the leading online marketplace where businesses thrive without barriers-offering a zero-commission 
                    platform that empowers vendors, fosters innovation, and enhances the shopping experience. Tastyhouse 
                    Stores envisions a future where entrepreneurs have full control over their success, customers enjoy 
                    seamless access to quality products, and digital commerce is more inclusive, efficient, and rewarding 
                    for all.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<!-- Client Section Start -->
{{--<section class="client-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="about-us-title text-center">
                    <h4>What We Do</h4>
                    <h2 class="center">We are Trusted by Clients</h2>
                </div>

                <div class="slider-3_1 product-wrapper">
                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="{{ asset('frontend/svg/3/work.svg') }}" class="blur-up lazyload svg-theme-color" alt="">
                            </div>
                            <h4>Business Years</h4>
                            <p>A coffee shop is a small business that sells coffee, pastries, and other morning
                                goods. There are many different types of coffee shops around the world.</p>
                        </div>
                    </div>

                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="{{ asset('frontend/svg/3/buy.svg') }}" class="blur-up lazyload svg-theme-color" alt="">
                            </div>
                            <h4>Products Sales</h4>
                            <p>Some coffee shops have a seating area, while some just have a spot to order and then
                                go somewhere else to sit down. The coffee shop that I am going to.</p>
                        </div>
                    </div>

                    <div>
                        <div class="clint-contain">
                            <div class="client-icon">
                                <img src="{{ asset('frontend/svg/3/user.svg') }}" class="blur-up lazyload svg-theme-color" alt="">
                            </div>
                            <h4>Happy Customers</h4>
                            <p>My goal for this coffee shop is to be able to get a coffee and get on with my day.
                                It's a Thursday morning and I am rushing between meetings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>--}}
<!-- Client Section End -->
@endsection