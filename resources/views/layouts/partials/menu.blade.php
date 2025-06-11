<div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
    <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
        <div class="offcanvas-header navbar-shadow">
            <h5>Menu</h5>
            <button class="btn-close lead" type="button"
                data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                {{--<li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                </li>--}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.prime') }}">Prime Products</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                        All Categories</a>
                    <div class="dropdown-menu dropdown-menu-3 dropdown-menu-2" style="z-index:11;">
                        <div class="row">
                            @foreach($th_categories1 as $cat1)
                            <div class="col-xl-3 mb-4">
                                <div class="dropdown-column m-0">
                                    @php $catSlug = \App\Models\ProductCategory::getSlug($cat1->title); @endphp
                                    <h5 class="dropdown-header">
                                        <a class="text-dark" href="{{ route('shop.category', ['id' => $cat1->id, 'slug' => $catSlug]) }}">{{ ucwords(strtolower($cat1->title)) }}</a>
                                    </h5>
                                    @foreach ($th_categories2 as $cat2)
                                        @if($cat2->parent == $cat1->id)
                                            @php $catSlug = \App\Models\ProductCategory::getSlug($cat2->title); @endphp
                                            <a class="dropdown-item" href="{{ route('shop.category', ['id' => $cat2->id, 'slug' => $catSlug]) }}">
                                                {{ ucwords(strtolower($cat2->title)) }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            {{--<div class="col-3 d-xl-block d-none">
                                <div class="dropdown-column m-0">
                                    <div class="menu-img-banner">
                                        <a class="text-title" href="#">
                                            <img src="{{ asset('frontend/images/mega-menu.png') }}" alt="banner">
                                        </a>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown dropdown-mega">
                    <a class="nav-link dropdown-toggle ps-xl-2 ps-0"
                        href="javascript:void(0)" data-bs-toggle="dropdown">Services</a>

                    <div class="dropdown-menu dropdown-menu-2">
                        <div class="row">
                            @php $services = \App\Models\ProductCategory::where('parent', 346)->get(); @endphp
                            @foreach($services as $item)
                                @php $catSlug = \App\Models\ProductCategory::getSlug($item->title); @endphp
                                <div class="dropdown-column col-xl-3">
                                    <a class="dropdown-item" href="{{ route('shop.category', ['id' => $item->id, 'slug' => $catSlug]) }}">{{ ucwords(strtolower($item->title)) }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                {{--<li class="nav-item">
                    <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                </li>--}}

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                        data-bs-toggle="dropdown">Vendor</a>
                    <ul class="dropdown-menu">
                        @guest('seller')
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.login') }}">Vendor Login</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.about') }}">Become a Vendor</a>
                            </li>
                        @endguest
                        
                        @auth('seller')
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.home') }}">Vendor Dashboard</a>
                            </li>
                            <li onclick="event.preventDefault(); document.getElementById('seller-logout-form').submit();">
                                <a class="dropdown-item" href="{{ route('seller.logout') }}">Vendor Logout</a>
                            </li>
                            <form id="seller-logout-form" action="{{ route('seller.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endauth
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ config('app.url2') }}" target="_blank">Chefs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ config('app.url').'/shop/category/374/delivery-service' }}">Delivery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ config('app.url2').'/all-vendors?restaurant=1' }}" target="_blank">Restaurant</a>
                </li>
            </ul>
        </div>
    </div>
</div>