<div class="category-menu">
    <a href="{{ url('/') }}" class="web-logo nav-logo">
        <img src="{{ asset('img/logo.png') }}" class="img-fluid blur-up lazyload" alt="">
    </a>
    <ul>
        <li>
            <div class="category-list">
                <img class="svg-theme-color" src="{{ asset('img/svg/home.svg') }}" class="blur-up lazyload" alt="">
                <h5>
                    <a href="{{ url('/') }}">Home</a>
                </h5>
            </div>
        </li>
        <li>
            <div class="category-list">
                <img class="svg-theme-color" src="{{ asset('frontend/svg/premium.svg') }}" class="blur-up lazyload" alt="">
                <h5>
                    <a href="{{ route('shop.prime') }}">Browse Prime</a>
                </h5>
            </div>
        </li>
        <li>
            <div class="category-list">
                <img class="svg-theme-color" src="{{ asset('img/svg/home-1.svg') }}" class="blur-up lazyload" alt="">
                <h5>
                    <a href="{{ route('shop') }}">All Properties</a>
                </h5>
            </div>
        </li>
        <li>
            <div class="category-list">
                <img class="svg-theme-color" src="{{ asset('img/svg/user-tie.svg') }}" class="blur-up lazyload" alt="">
                <h5>
                    <a href="{{ route('seller.home') }}">Vendor Portal</a>
                </h5>
            </div>
        </li>
        @foreach($th_categories1 as $cat)
            @php 
                $catSlug = \App\Models\ProductCategory::getSlug($cat->title);
                $catUrl = route('shop.category', ['id' => $cat->id, 'slug' => $catSlug]);
            @endphp
            <li>
                <div class="category-list">
                    <img class="svg-theme-color" src="{{ asset($cat->icon) }}" class="blur-up lazyload" alt="">
                    <h5>
                        <a href="{{ $catUrl }}">{{ ucwords(strtolower($cat->title)) }}</a>
                    </h5>
                </div>
            </li>
        @endforeach
    </ul>
</div>