@extends('layouts.app', ['title' => 'Prime Shop', 'activePage' => 'shop'])

@section('content')
<section class="section-b-space shop-section">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-custom-3 order-2 order-md-2 order-lg-1 order-xl-1">
                <div class="left-box wow fadeInUp">
                    <div class="shop-left-sidebar">
                        <div class="left-search-box">
                            <form class="search-box" action="{{ route('shop.search') }}" method="GET">
                                <input type="search" class="form-control" id="exampleFormControlInput1" name="search"
                                    placeholder="Search....">
                            </form>
                        </div>

                        <div class="accordion custom-accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        <span>Categories</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">

                                        <ul class="category-list custom-padding custom-heigh" style="max-height:100vw;">
                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <label class="form-check-label" for="fruit">
                                                        <img src="{{ asset('frontend/svg/premium.svg') }}" alt="" style="max-width:20px; margin-right:5px;">
                                                        <a class="name" href="{{ route('shop.prime') }}">Prime Products</a>
                                                    </label>
                                                </div>
                                            </li>
                                            @foreach($th_categories1 as $cat1)
                                            <li>
                                                <div class="form-check ps-0 m-0 category-list-box">
                                                    <label class="form-check-label" for="fruit">
                                                        <img src="{{ asset($cat1->icon) }}" alt="" style="max-width:20px; margin-right:5px;">
                                                        @php $catSlug = \App\Models\ProductCategory::getSlug($cat1->title); @endphp
                                                        <a class="name" href="{{ route('shop.category', ['id' => $cat1->id, 'slug' => $catSlug]) }}">
                                                            {{ ucwords(strtolower($cat1->title)) }}</a>
                                                        {{--<span class="number">(15)</span>--}}
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-custom- order-1 order-md-1 order-lg-2 order-xl-2">
                <h5 class="text-content mb-4">@isset($locationData) Products in {{ $locationData->name }} @endisset</h5>
                <div class="show-button">
                    <div class="top-filter-menu-2">
                        <div class="sidebar-filter-menu" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample">
                            <a href="javascript:void(0)"><i class="fa-solid fa-filter"></i> Filter Menu</a>
                        </div>
                        <div class="ms-auto d-flex align-items-center">
                            <div class="category-dropdown me-md-3">
                                <h5 class="text-content">Sort By :</h5>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown">
                                        <span>{{ isset($_GET['sort_by']) ? ucwords(str_replace('_', ' ', $_GET['sort_by'])) : 'Most Recent' }}</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="pop" href="{{ request()->fullUrlWithQuery(['sort_by' => 'popularity']) }}">
                                                Popularity</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="new" href="{{ request()->fullUrlWithQuery(['sort_by' => 'newest']) }}">
                                                Newest</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="low" href="{{ request()->fullUrlWithQuery(['sort_by' => 'lowest_price']) }}">
                                                Lowest Price First</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="high" href="{{ request()->fullUrlWithQuery(['sort_by' => 'highest_price']) }}">
                                                Highest Price First</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="grid-option grid-option-2">
                            <ul>
                                <li class="three-grid">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/svg/grid-3.svg') }}" class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                                <li class="grid-btn five-grid d-xxl-inline-block d-none">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/svg/grid-4.svg') }}"
                                            class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                    </a>
                                </li>
                                <li class="list-btn">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/svg/list.svg') }}" class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <form class="top-filter-category" id="collapseExample" method="GET" action="{{ request()->fullUrl() }}">
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-3 col-md-6">
                            <div class="category-title">
                                <h3>Price</h3>
                            </div>
                            <div class="range-slider">
                                <input type="text" class="js-range-slide form-control" id="price-filter-range" name="price_range" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row g-sm-4 g-3 py-3">
                        <div class="col-6">
                            <button class="btn btn-sm btn-animation">Filter</button>
                        </div>
                    </div>
                </form>

                <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                    @foreach($products as $product)
                    <div>
                        <div class="product-box-3 h-100 wow fadeInUp">
                            @if($product->prime_status == 1)
                                <span class="product-badge">Prime</span>
                            @endif
                            <div class="product-header">
                                <div class="product-image">
                                    @php $thumbnail = json_decode($product->image)[0]; @endphp
                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                            class="img-fluid blur-up lazyload" alt="" style="height:auto;">
                                    </a>

                                    <ul class="product-option justify-content-center">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-detail text-center">
                                    <span class="span-name">{{ ucwords(strtolower($product->category->title)) }}</span>
                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                        <h5 class="name">{{ $product->title }}</h5>
                                    </a>
                                    <div class="product-rating review-rating justify-content-center">
                                        <ul class="rating">
                                            <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                            @for($i=1; $i <= 5; $i++)
                                                <li>
                                                    <i data-feather="star" class="{{ ($i <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span class="content-color">({{ $avg_rating }})</span>
                                    </div>
                                    <p class="text-content mt-1 mb-2 product-content">{{ $product->description }}</p>
                                    <h5 class="price">
                                        @if(!in_array($product->price_type, ['fixed', 'negotiable']))
                                            <span class="theme-color">{{ ucwords(str_replace('_', ' ', $product->price_type)) }}</span>
                                        @elseif($product->price_type == 'negotiable')
                                            <span class="theme-color">{{ $currency.number_format($product->price, 2) }} <br><small class="text-dark">Negotiable</small></span>
                                        @else
                                            <span class="theme-color">{{ $currency.number_format($product->price, 2) }}</span>
                                        @endif
                                    </h5>
                                    <h6 class="unit">
                                        <i class="fa fa-map-marker-alt"></i> &nbsp; {{ $product->city->name .', '.$product->city->state->name }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <nav class="custom-pagination">
                    {{ $products->appends($_GET)->links() }}
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection