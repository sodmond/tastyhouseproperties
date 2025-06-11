<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Terms & Conditions', 'activePage' => 'tandc'])

@section('content')
<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-12 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h4>Terms & Conditions</h4>
                            <h2>Welcome to TastyHouse Stores</h2>
                        </div>

                        <div class="delivery-list">
                            <p class="text-content">At Tastyhouse Stores, we believe that selling online should be easy, fair, and rewarding. That's why we've built a marketplace where vendors can connect with customers effortlessly, all without the hassle of commission fees. With our zero-commission model, sellers keep 100% of their earnings—giving you the freedom to focus on growing your business and serving your customers.</p>
                            <p class="text-content">Whether you're just starting out or you're an established brand looking to reach new customers, Tastyhouse Stores provides you with the tools and exposure you need to thrive. But before you start, please take a moment to read through our terms and conditions to understand how our platform works and what we expect from everyone using it.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">1. Getting Started</h4>
                            <p>To join Tastyhouse Stores, you’ll need to create an account. Whether you’re a buyer or seller, we ask that you provide accurate information and keep your account details secure. If you’re selling, you’ll need to provide your product listings, and if you’re buying, simply browse and purchase the items that catch your eye!</p>
                        </div>
                        <div>
                            <h4 class="mb-2">2. Selling on Tastyhouse Stores</h4>
                            <p>As a seller, you can list products without worrying about commission fees. This means you’ll keep 100% of what you earn! Simply ensure your listings are accurate and your products are ready for delivery, and you’re good to go.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">3. Buying on Tastyhouse Stores</h4>
                            <p>If you’re a buyer, you’ll find a wide variety of products from amazing vendors. Once you find what you’re looking for, check out and make your payment securely. You’ll get timely updates on your order, and our vendors are committed to delivering the best service.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">4. Shipping and Delivery</h4>
                            <p>Sellers handle their own shipping, but don’t worry—we expect our vendors to ship products on time and provide tracking information whenever possible. Buyers, make sure your shipping info is accurate so there are no delays in getting your items to you!</p>
                        </div>
                        <div>
                            <h4 class="mb-2">5. Returns and Refunds</h4>
                            <p>If you’re not satisfied with a product, it’s best to review the seller’s return and refund policy before purchasing. Sellers are responsible for their own policies, and we encourage them to keep their buyers happy!</p>
                        </div>
                        <div>
                            <h4 class="mb-2">6. What You Can’t Do</h4>
                            <p>We’re all about making things simple and enjoyable. So, please don’t use our platform to sell anything illegal or harmful. Let’s keep it fair for everyone.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">7. Protecting Your Privacy</h4>
                            <p>We respect your privacy. When you use Tastyhouse Stores, we protect your personal information. We take security seriously and make sure your data is handled with care.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">8. Getting Help</h4>
                            <p>If you need help, whether you're a buyer or a seller, don’t hesitate to reach out to us. We’re here to make sure your experience is smooth and easy. If you have any questions, you can contact us at support@tastyhousestores.com</p>
                        </div>
                        <div>
                            <h4 class="mb-2">9. Changes to These Terms</h4>
                            <p>As we continue to grow, we may update these terms from time to time. When that happens, we’ll post the updated terms here. We encourage you to check back and stay informed.</p>
                        </div>
                        <div>
                            <h4 class="mb-2">10. Our Commitment</h4>
                            <p>Tastyhouse Stores is all about making e-commerce simple, fair, and rewarding for everyone. We’re excited to have you on board, whether you’re selling or buying, and we can’t wait to see how you grow with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection