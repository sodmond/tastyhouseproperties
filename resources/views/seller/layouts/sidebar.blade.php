<div class="dashboard-left-sidebar">
    <div class="close-button d-flex d-lg-none">
        <button class="close-sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="profile-box">
        <div class="cover-image">
            <img src="{{ asset('frontend/images/inner-page/cover-img.jpg') }}" class="img-fluid blur-up lazyload"
                alt="">
        </div>

        <div class="profile-contain">
            <div class="profile-image">
                <div class="position-relative">
                    @php $profilepix = asset(empty(auth('seller')->user()->image) ? 'img/user-icon.png' : 'storage/seller/profile_pix/'.auth('seller')->user()->image ); @endphp
                    <img src="{{ $profilepix }}" class="blur-up lazyload update_img" alt="">
                </div>
            </div>

            <div class="profile-name">
                <h3>{{ ucwords(auth('seller')->user()->firstname.' '.auth('seller')->user()->lastname) }}</h3>
                <h6 class="text-content">{{ auth('seller')->user()->email }}</h6>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.home' ? 'active' : '' }}" href="{{ route('seller.home') }}">
                <i data-feather="home"></i>Dashboard</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.products' ? 'active' : '' }}" href="{{ route('seller.products') }}">
                <i data-feather="list"></i>Properties</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.messages' ? 'active' : '' }}" href="{{ route('seller.messages') }}">
                <i data-feather="inbox"></i>Messages</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.reviews' ? 'active' : '' }}" href="{{ route('seller.reviews') }}">
                <i data-feather="star"></i>Reviews</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.profile' ? 'active' : '' }}" href="{{ route('seller.profile') }}">
                <i data-feather="user"></i>Profile</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activePage == 'seller.settings' ? 'active' : '' }}" href="{{ route('seller.settings') }}" >
                <i data-feather="settings"></i>Subscription</a>
        </li>

        <li class="nav-item" onclick="event.preventDefault(); document.getElementById('seller-logout-form').submit();">
            <a class="nav-link" href="{{ route('seller.logout') }}">
                <i data-feather="log-out"></i> Log Out</a>
        </li>
    </ul>
</div>