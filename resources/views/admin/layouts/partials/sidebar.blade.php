<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{ route('admin.home') }}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset('img/logo-white.png') }}" alt="TastyHouse">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('admin.home') }}">
                <img class="img-fluid main-logo main-white" src="{{ asset('backend/images/logo/logo.png') }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset('backend/images/logo/logo-white.png') }}"
                    alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.home') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title {{ ($activePage == 'products') ? 'active' : '' }}" href="javasscript:void(0);">
                            <i class="ri-store-3-line"></i>
                            <span>Products</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.products') }}">Product List</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.abusereports') }}">Abuse Reports</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title {{ ($activePage == 'categories') ? 'active' : '' }}" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.categories') }}">Category List</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.category.new') }}">Add New Category</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title {{ ($activePage == 'attributes') ? 'active' : '' }}" href="javascript:void(0)">
                            <i class="ri-list-settings-line"></i>
                            <span>Attributes</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.attributes') }}">Attributes</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.attributes.new') }}">Add Attributes</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav active{{ ($activePage == 'users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ ($activePage == 'vendors') ? 'active' : '' }}" href="{{ route('admin.vendors') }}">
                            <i class="fa fa-user-tie"></i>
                            <span>Vendors</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ ($activePage == 'orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title {{ ($activePage == 'blog') ? 'active' : '' }}" href="javascript:void(0)">
                            <i class="far fa-newspaper"></i>
                            <span>Blog</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.blog') }}">All Articles</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.blog.new') }}">Add New Article</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.subscriptions') }}">
                            <i class="fas fa-credit-card"></i>
                            <span>Subscriptions</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.settings.home') }}">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="fa fa-users-cog"></i>
                            <span>Account</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('admin.profile') }}">My Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile.password') }}">Change Password</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{ route('admin.logout') }}">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
