<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Terms & Conditions', 'activePage' => 'tandc'])

@section('content')
<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-xs">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-12 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h4>Terms & Conditions</h4>
                            <h2>Welcome to TastyHouse Properties</h2>
                        </div>

                        <div class="delivery-list">
                            <p class="text-content">At Tastyhouse Properties, we believe that online business should be easy, fair, and rewarding. That's why we've built a beautiful marketplace where vendors can connect with customers effortlessly, all without the hassle of commission fees. With our zero-commission model, sellers keep 100% of their earnings—giving you the freedom to focus on growing your business and serving your customers.</p>
                            <p class="text-content">Whether you're just starting or you're an established brand looking to reach new customers, Tastyhouse Properties provides you with the tools and exposure you need to thrive. But before you start, please take a moment to read through our terms and conditions to understand how our platform works and what we expect from everyone using it.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">1. Getting Started</h4>
                            <p>To join Tastyhouse Properties, you’ll need to create an account. Whether you’re buying, renting, leasing or selling, we ask that you provide accurate information and keep your account details secure.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">2. Selling on Tastyhouse Properties</h4>
                            <p>As a seller, you can list properties without worrying about commission fees. This means you’ll keep 100% of what you earn! Simply ensure your listings are accurate with safety in mind. </p>
                        </div>
                        <div>
                            <h4 class="mb-2">3. Buying, renting or leasing on Tastyhouse Properties</h4>
                            <p>We have a wide variety of properties from amazing Estate Agents, Developers and direct owners. Tastyhouse Properties is a marketplace and we do not take responsibility for business transactions between customers and advertisers. Once you find your desired property, we recommend that you vet the advertiser thoroughly and check all necessary information regarding the property before making any payment. Read our disclaimer information on the property listing page for your safety.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">4. Refunds</h4>
                            <p>We recommend that customers review the advertiser's refund policy thoroughly before purchasing, leasing or renting. Sellers are responsible for their policies, and we encourage them to keep their customers happy!</p>
                        </div>
                        <div>
                            <h4 class="mb-2">5. What You Can’t Do</h4>
                            <p>We’re all about making things simple and enjoyable. So, please don’t use our platform to sell anything illegal or harmful. Let’s keep it fair and safe for everyone.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">6. Protecting Your Privacy</h4>
                            <p>We respect your privacy. When you use Tastyhouse Properties, we protect your personal information. We take security seriously and make sure your data is handled with care.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">7. Getting Help</h4>
                            <p>If you need help or more information, don’t hesitate to reach out to us. We’re here to make sure your experience is smooth and easy with safety in mind. If you have any questions, you can contact us at support@tastyhouseproperties.com</p>
                        </div>
                        <div>
                            <h4 class="mb-2">8. Changes to These Terms</h4>
                            <p>As we continue to grow, we may update these terms from time to time. When that happens, we’ll post the updated terms here. We encourage you to check back and stay informed.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">9. Our Commitment</h4>
                            <p>Tastyhouse Properties is all about making e-commerce simple, fair, and rewarding for everyone. We’re excited to have you on board and we can’t wait to see how you grow with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection