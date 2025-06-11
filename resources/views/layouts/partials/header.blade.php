<header class="pb-md-4 pb-0">
    @include('layouts.partials.topbar')

    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <a href="{{ url('/') }}" class="web-logo nav-logo">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid blur-up lazyload" alt="">
                        </a>

                        <div class="middle-box">
                            <div class="location-box">
                                <button class="btn location-button">
                                    <span class="location-arrow"><i data-feather="map-pin"></i></span>
                                    <span class="locat-name">{{ $th_location_name; }}</span>
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </div>

                            <form class="search-box" method="GET" action="{{ route('shop.search') }}">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="I'm searching for...">
                                    <button class="btn" type="submit" id="button-addon2">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="{{ route('contact') }}" class="delivery-login-box" style="cursor: pointer;">
                                        <div class="delivery-icon">
                                            <i data-feather="phone-call"></i>
                                        </div>
                                        
                                    </a>
                                </li>
                                <li class="right-side">
                                    <a href="{{ route('user.wishlist') }}" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
                                </li>
                                <li class="right-side" id="mobile-location-box">
                                    <div class="location-box">
                                        <button class="btn location-button">
                                            <span class="location-arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                            </span>
                                            <span class="locat-name">{{ $th_location_name; }}</span>
                                            <i class="fa-solid fa-angle-down"></i>
                                        </button>
                                    </div>
                                </li>
                                <li class="right-side header-badge">
                                    <a href="{{ auth('seller')->check() ? route('seller.messages') : route('user.messages') }}" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="inbox"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge" id="th-inbox-count">
                                            @if(auth('seller')->check())
                                                {{ \App\Models\Chat::unreadMsgCount('seller', auth('seller')->id()) }}
                                            @elseif(auth('web')->check())
                                                {{ \App\Models\Chat::unreadMsgCount('user', auth('web')->id()) }}
                                            @else
                                            0
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>Hello,</h6>
                                            <h5>My Account</h5>
                                        </div>
                                    </div>

                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                            @auth('web')
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{ route('user.home') }}">User Dashboard</a>
                                                </li>

                                                <li class="product-box-contain" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <a href="{{ route('logout') }}">Logout</a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            @endauth

                                            @guest('web')
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{ route('login') }}">User Login</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="{{ route('register') }}">User Register</a>
                                                </li>
                                            @endguest
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="header-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category">
                            <i data-feather="align-left"></i>
                            <span>All Categories</span>
                        </button>

                        <div class="category-dropdown" style="z-index:12;">
                            <div class="category-title">
                                <h5>Categories</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <ul class="category-list">
                                <li class="onhover-category-list">
                                    <a href="{{ route('shop.prime') }}" class="category-name">
                                        <img src="{{ asset('frontend/svg/premium.svg') }}" alt="">
                                        <h6>Prime Products</h6>
                                    </a>
                                </li>
                                @foreach($th_categories1 as $cat1)
                                    <li class="onhover-category-list">
                                        <a href="javascript:void(0)" class="category-name">
                                            <img src="{{ asset($cat1->icon) }}" alt="">
                                            <h6>{{ ucwords(strtolower($cat1->title)) }}</h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>

                                        <div class="onhover-category-box">
                                            @foreach($th_categories2 as $cat2)
                                                @if($cat2->parent == $cat1->id)
                                                    <div class="list-1">
                                                        <div class="category-title-box pt-4">
                                                            <h5>
                                                                @php $catSlug = \App\Models\ProductCategory::getSlug($cat2->title); @endphp
                                                                <a href="{{ route('shop.category', ['id' => $cat2->id, 'slug' => $catSlug]) }}">
                                                                    {{ ucwords(strtolower($cat2->title)) }}</a>
                                                            </h5>
                                                        </div>
                                                        <ul>
                                                            @foreach($th_categories3 as $cat3)
                                                                @if($cat3->parent == $cat2->id)
                                                                    <li>
                                                                        @php $catSlug = \App\Models\ProductCategory::getSlug($cat3->title); @endphp
                                                                        <a href="{{ route('shop.category', ['id' => $cat3->id, 'slug' => $catSlug]) }}">
                                                                            {{ ucwords(strtolower($cat3->title)) }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="header-nav-middle" style="z-index:15;">
                        @include('layouts.partials.menu')
                    </div>

                    <div class="header-nav-right">
                        {{--<button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                            <i data-feather="zap"></i>
                            <span>Deal Today</span>
                        </button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>