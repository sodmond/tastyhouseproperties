<div class="page-header">
    <div class="header-wrapper m-0">
        <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
                <a href="{{ route('admin.home') }}">
                    <img class="img-fluid main-logo" src="{{ asset('img/logo.png') }}" alt="logo">
                    <img class="img-fluid white-logo" src="{{ asset('img/logo-white.png') }}" alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                <a href="{{ route('admin.home') }}">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="">
                </a>
            </div>
        </div>

        <form class="form-inline search-full" action="javascript:void(0)" method="get">
            {{--<div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search TastyHouse .." name="search" title="" autofocus>
                        <i class="close-search" data-feather="x"></i>
                        <div class="spinner-border Typeahead-spinner" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>--}}
        </form>
        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode">
                        <i class="ri-moon-line"></i>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <img class="user-profile rounded-circle" src="{{ asset('img/user-icon.png') }}" alt="">
                        <div class="user-name-hide media-body">
                            <span>{{ auth('admin')->user()->firstname.' '.auth('admin')->user()->lastname }}</span>
                            <p class="mb-0 font-roboto">Admin<i class="middle ri-arrow-down-s-line"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{ route('admin.profile') }}">
                                <i data-feather="user"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.profile.password') }}">
                                <i data-feather="lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.home') }}">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>