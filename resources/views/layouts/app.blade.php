<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('app.name') }} - the marketplace built for vendors, designed for success">
    <meta name="keywords"
        content="tastyhouse, stores, store, tastyhouse stores, marketplace, online marketplace, vendors, buyers, customers, digital commerce, ecommerce, products, quality products, online shopping, customer satisfaction">
    <meta name="author" content="WMA Tech Junkies">
    <meta name="csrf-token" content="{{ @csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') . ' - ' . $title }}</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link id="color-link-2" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
</head>

<body class="theme-color-4">

    <!-- Header Start -->
    @include('layouts.partials.header')
    <!-- Header End -->

    <!-- mobile fix menu start -->
    @include('layouts.partials.mobile_menu')
    <!-- mobile fix menu end -->

    <!-- Content Section Start -->
    <section class="product-section pt-0">
        <div class="container-fluid p-0">
            <div class="custom-row">
                <div class="sidebar-col">
                    @include('layouts.partials.menu')
                </div>
                <div class="content-col">
                    @if ($activePage != 'home')
                        @include('layouts.partials.breadcrumb')
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section Start -->
    @include('layouts.partials.footer')
    <!-- Footer Section End -->

    @include('layouts.partials.location_menu')

    <!-- Cookie Bar Box Start -->
    {{--<div class="cookie-bar-box">
        <div class="cookie-box">
            <div class="cookie-image">
                <img src="{{ asset('frontend/images/cookie-bar.png') }}" class="blur-up lazyload" alt="">
                <h2>Cookies!</h2>
            </div>

            <div class="cookie-contain">
                <h5 class="text-content">We use cookies to make your experience better</h5>
            </div>
        </div>

        <div class="button-group">
            <button class="btn privacy-button">Privacy Policy</button>
            <button class="btn ok-button">OK</button>
        </div>
    </div>--}}
    <!-- Cookie Bar Box End -->

    <!-- Deal Box Modal Start -->
    {{--<div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="{{ asset('frontend/images/vegetable/product/10.png') }}" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- Deal Box Modal End -->

    <!-- Newsletter Modal -->
    <div class="modal fade theme-modal remove-coupon show" id="newsletterModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form class="modal-content" method="POST" action="{{ route('newsletter') }}" style="width:500px;">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Confirm You Are Not A Robot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <div class="col-12 mb-4">
                            @csrf
                            <input type="hidden" name="email" id="newsletter_email_2">
                            {!! htmlFormSnippet() !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm fw-bold">Proceed</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Newsletter Modal Ends -->

    <!-- Tap to top and theme setting button start -->
    <div class="theme-option">
        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <form id="seller-logout-form" action="{{ route('seller.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- latest jquery-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap/popper.min.js') }}"></script>
    @vite(['resources/js/app.js'])

    <!-- feather icon js-->
    <script src="{{ asset('frontend/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('frontend/js/slick/slick.js') }}"></script>
    <script src="{{ asset('frontend/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('frontend/js/auto-height.js') }}"></script>

    <!-- Price Range Js -->
    <script src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Timer Js -->
    {{--<script src="{{ asset('frontend/js/timer1.js') }}"></script>--}}

    <!-- Fly Cart Js -->
    <script src="{{ asset('frontend/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('frontend/js/quantity-2.js') }}"></script>

    <!-- Zoom Js -->
    <script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('frontend/js/zoom-filter.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('frontend/js/script.js') }}"></script>

    <!-- theme setting js -->
    {{--<script src="{{ asset('frontend/js/theme-setting.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/bootstrap-rating-input.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tastyhouse.js') }}"></script>
    <script>
        $(document).ready(function(){ 
            var input_group = $('input[required]').parent();
            input_group.find('label').addClass('required');
            var select_group = $('select[required]').parent();
            select_group.find('label').addClass('required');
            var textarea_group = $('textarea[required]').parent();
            textarea_group.find('label').addClass('required');

        });
        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault();
            $('#newsletter_email_2').val($('#newsletter_email_1').val());
            $('#newsletterModal').modal('show');
        });
        $('.location-button').on('click', function(e){
            e.preventDefault();
            $('#locationModal').modal('show');
        });
        $('#price-filter-range').ionRangeSlider({
            type: "double",
            min: 0,
            max: 100000000,
            from: 5000,
            step: 50000,
            prefix: '{{$currency}} ',
            prettify_enabled: true,
            prettify_separator: ",",
            values_separator: " - ",
            force_edges: true
        });
    </script>
    @stack('custom-script')
    {!! htmlScriptTagJsApi() !!}
    @if (session('newsletter_suc'))
    <script>
        $(document).ready(function() {
            $('#newsletterModal .remove-box').html('<div class="alert alert-success" role="alert">You have successfully subscribed to our newsletter</div>');
            $('#newsletterModal .modal-footer').hide();
            $('#newsletterModal .modal-title').text('Newsletter Status');
            $('#newsletterModal').modal('show');
        });
    </script>
    @endif
    @auth('web')
        <script>
            $(document).ready(function(){
                const userId = {{ auth('web')->id() }};
                window.Echo.channel(`chat`).listen('.chat.sent', (e) => {
                    if(e.user_id == userId && e.sender == 'seller') {
                        let inboxcount = parseInt($('#th-inbox-count').text());
                        $('#th-inbox-count').text(inboxcount+1);
                    }
                });
            });
        </script>
    @endauth
    @auth('seller')
        <script>
            $(document).ready(function(){
                const sellerId = {{ auth('seller')->id() }};
                window.Echo.channel(`chat`).listen('.chat.sent', (e) => {
                    if(e.seller_id == sellerId && e.sender == 'user') {
                        let inboxcount = parseInt($('#th-inbox-count').text());
                        $('#th-inbox-count').text(inboxcount+1);
                    }
                });
            });
        </script>
    @endauth
</body>

</html>