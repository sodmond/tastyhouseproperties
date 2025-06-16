<header class="pb-0 fixed-header">
    <div class="top-nav top-header">
        <div class="container-fluid-xs">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon navbar-toggler-icon-2">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <a href="{{ url('/') }}" class="web-logo nav-logo">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid blur-up lazyload" alt="">
                        </a>

                        <div class="middle-box">
                            <div class="location-box">
                                <button class="btn location-button" data-bs-toggle="modal" data-bs-target="#locationModal">
                                    <span class="location-arrow">
                                        <i data-feather="map-pin"></i>
                                    </span>
                                    <span class="locat-name">{{ $th_location_name; }}</span>
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </div>

                            <form class="search-box" method="GET" action="{{ route('shop.search') }}">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="I'm searching for...">
                                    <button class="btn bg-theme" type="button" id="button-addon2">
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
                                <li class="right-side" id="mobile-location-box">
                                    <div class="location-box">
                                        <button class="btn btn-sm location-button">
                                            <span class="location-arrow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                            </span>
                                            <span class="locat-name">{{ $th_location_name; }}</span>
                                            <i class="fa-solid fa-angle-down"></i>
                                        </button>
                                    </div>
                                </li>
                                <li class="right-side wishlist">
                                    <a href="{{ route('user.wishlist') }}" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
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
</header>