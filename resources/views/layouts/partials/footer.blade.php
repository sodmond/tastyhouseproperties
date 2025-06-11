<footer class="section-t-space">
    <div class="container-fluid-lg">

        <div class="main-footer section-b-space section-t-space" style="border-top: 0;">
            <div class="row g-md-4 g-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-logo">
                        <div class="theme-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/logo.png') }}" class="blur-up lazyload" alt="">
                            </a>
                        </div>

                        <div class="footer-logo-contain">
                            <p>We believe that selling online should be simple, fair, and rewarding.
                                Tastyhouse Stores gives you the tools and visibility you need to succeed. 
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Categories</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            @for($i=0; $i < 6; $i++)
                            <li>
                                @php $catSlug = \App\Models\ProductCategory::getSlug($th_categories1[$i]->title); @endphp
                                <a href="{{ route('shop.category', ['id' => $th_categories1[$i]->id, 'slug' => $catSlug]) }}" class="text-content">
                                    {{ ucwords(strtolower($th_categories1[$i]->title)) }}</a>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>

                <div class="col-xl col-lg-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Useful Links</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="{{ url('/') }}" class="text-content">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('shop') }}" class="text-content">Shop</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="text-content">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('blog') }}" class="text-content">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-content">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Help Center</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="{{ route('user.home') }}" class="text-content">Your Account</a>
                            </li>
                            <li>
                                <a href="{{ route('user.wishlist') }}" class="text-content">Your Wishlist</a>
                            </li>
                            <li>
                                <a href="{{ route('tandc') }}" class="text-content">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-content">FAQ</a>
                            </li>
                            <li>
                                <a href="{{ route('advertise') }}" class="text-content">Advertise</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Contact Us</h4>
                    </div>

                    <div class="footer-contact">
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <i data-feather="phone"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5>+2349051802727</h5>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="footer-number">
                                    <i data-feather="mail"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Email Address :</h6>
                                        <h5>support@tastyhousestores.com</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="social-app mb-0">
                                <h5 class="mb-2 text-content">Download App :</h5>
                                <ul>
                                    <li class="mb-0">
                                        <a href="https://play.google.com/store/apps" target="_blank">
                                            <img src="{{ asset('frontend/images/playstore.svg') }}" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="mb-0">
                                        <a href="https://www.apple.com/in/app-store/" target="_blank">
                                            <img src="{{ asset('frontend/images/appstore.svg') }}" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="reserve">
                <h6 class="text-content">© 2025 {{ config('app.name') }} All rights reserved</h6>
            </div>

            <div class="payment">
                {{--<img src="{{ asset('frontend/images/payment/1.png') }}" class="blur-up lazyload" alt="">--}}
            </div>

            <div class="social-link">
                <h6 class="text-content">Stay connected :</h6>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" target="_blank">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.pinterest.com/" target="_blank">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>