@extends('layouts.app', ['title' => 'Search', 'activePage' => 'search'])

@section('content')
<!-- Search Bar Section Start -->
<section class="search-section">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-xxl-6 col-xl-8 mx-auto">
                <div class="title d-block text-center">
                    <h2>Search for products</h2>
                    <span class="title-leaf">
                        &nbsp;
                    </span>
                </div>

                <div class="search-box">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Enter search text here...." required min="3">
                            <button class="btn theme-bg-color text-white m-0" type="submit" id="button-addon1">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Search Bar Section End -->

@if(!isset($products))
<section class="search-section mb-4">
    <div class="container-fluid-lg">
        <div class="row mb-4">
            <div class="col-12 text-center mb-4">
                <em class="fs-4">No result found!</em>
            </div>
        </div>
    </div>
</section>
@else
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="show-button">

                    <div class="top-filter-menu">
                        <div class="category-dropdown">
                            <h5 class="text-content">Search results for: <strong>{{ $_GET['search'] }}</strong></h5>
                        </div>
                        <div class="grid-option d-none d-md-block">
                            <ul>
                                <li class="three-grid">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/svg/grid-3.svg') }}" class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                                <li class="grid-btn d-xxl-inline-block d-none active">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('frontend/svg/grid-4.svg') }}"
                                            class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                        <img src="{{ asset('frontend/svg/grid.svg') }}"
                                            class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
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

                @if ($products->count() < 1)
                <div class="row mb-4">
                    <div class="col-12 text-center mb-4">
                        <em class="fs-4">No result found!</em>
                    </div>
                </div>
                @endif

                <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-5 row-cols-md-4 row-cols-2 product-list-section">
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
                                            <span class="theme-color">{{ $currency.number_format($product->price, 2) }} <small class="text-dark">Negotiable</small></span>
                                        @else
                                            <span class="theme-color">{{ $currency.number_format($product->price, 2) }}</span>
                                        @endif
                                    </h5>
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
@endif
@endsection