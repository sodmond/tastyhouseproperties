@extends('layouts.app', ['title' => 'Home', 'activePage' => 'home'])

@section('content')
<!-- Banner Section Start -->
<div class="section-b-space">
    <div class="row g-md-4 g-3">
        <div class="col-xxl-12 col-xl-12 col-md-12">
            @php 
            $ad_big = $adverts->where('slug', "homepage-big")->first();
            $adImage = asset('storage/advert/'.$ad_big->image) ?? asset('img/adverts/ad_big.png');
            $buttonText = $ad_big->button_text ?? 'Click here';
            $adUrl = $ad_big->url ?? '#';
            if ($ad_big->end_date < date('Y-m-d')) {
                $adImage = asset('img/adverts/ad_big.png');
                $buttonText = 'Contact';
                $adUrl = route('advertise');
            }
            @endphp
            <div class="banner-contain hover-effect">
                <img src="{{ $adImage }}" class="bg-img blur-up lazyload"
                    alt="">
                <div class="banner-details p-center-left p-sm-5 p-4">
                    <div style="padding: 150px 0px;">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->

<!-- Prime Section Start Here -->
<div class="title d-block">
    <h2 class="text-theme font-sm">Browse Prime Properties</h2>
    <p>Shop our exclusive 'Prime Properties' - featured items handpicked for you by our trusted vendors!</p>
</div>

<div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
    @foreach($primeProducts as $product)
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
<!-- Prime Section Ends Here -->

<!-- Categories Section Start -->
<section class="product-section">
    <div class="row g-sm-4 g-3">
        <div class="col-xxl-12 col-xl-12">
            <div class="title">
                <h2>Browse by Categories</h2>
                <span class="title-leaf">
                    &nbsp;
                </span>
                <p>Explore a variety of options by browsing through our easy-to-navigate categories!</p>
            </div>

            <div class="category-slider-2 product-wrapper no-arrow mb-4">
                @foreach($th_categories1 as $cat)
                @php 
                    $catSlug = \App\Models\ProductCategory::getSlug($cat->title);
                    $catUrl = route('shop.category', ['id' => $cat->id, 'slug' => $catSlug]);
                @endphp
                <div>
                    <a href="{{ $catUrl }}" class="category-box category-dark">
                        <div>
                            <img src="{{ asset($cat->icon) }}" class="blur-up lazyload" alt="">
                            <h5>{{ ucwords(strtolower($cat->title)) }}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section Start -->

<!-- Slider Section Start -->
<section class="banner-section ratio_60 wow fadeInUp mb-4">
    <div class="banner-slider">
        @php
            $ad_slider = $adverts->where('slug', 'homepage-slider');
            $num = 1;
        @endphp
        @foreach($ad_slider as $ad)
            @php
            $adImage = asset('storage/advert/'.$ad->image) ?? asset('img/adverts/ad_slider_'.$num.'.png');
            $buttonText = $ad->button_text ?? 'Contact';
            $adUrl = $ad->url ?? '#';
            if ($ad->end_date < date('Y-m-d')) {
                $adImage = asset('img/adverts/ad_slider_'.$num.'.png');
                $buttonText = 'Contact';
                $adUrl = route('advertise');
            }
            @endphp
            <div>
                <div class="banner-contain hover-effect">
                    <a href="{{ $adUrl }}" target="_blank">
                        <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                    </a>
                </div>
            </div>
            @php $num++ @endphp
        @endforeach
    </div>
</section>
<!-- Slider Section End -->

{{--<section class="product-section d-block d-sm-none" id="plugview">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="title">
                    <h2>Plugview Newsroom</h2>
                    <span class="title-leaf">
                        &nbsp;
                    </span>
                    <p>Fresh Video Updates, Hot Deals & Streaming News</p>
                </div>

                @if($plugview['default']->access_token == 'youtube')
                    <div class="videoEmbed">
                        <iframe width="560" height="315" src="{{ $plugview['youtube']->access_token }}" 
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                @else
                    <video controls autoplay="true" style="width:100%; height:auto">
                        <source src="{{ asset('storage/'.$plugview['mp4']->access_token) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>
    </div>
</section>--}}

{{--
<section class="product-section">
    <div class="row g-sm-4 g-3">
        <div class="col-xxl-12 col-xl-12">
            <div class="title d-block">
                <h2>Prime Vendors</h2>
                <span class="title-leaf">
                    &nbsp;
                </span>
                <p>Meet our 'Prime Vendors' - trusted sellers offering top-quality products just for you!</p>
            </div>

            <div class="product-border overflow-hidden wow fadeInUp">
                <div class="product-box-slider no-arrow">
                    @foreach($primeVendors as $seller)
                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <?php $sellerImg = empty($seller->image) ? 'img/th-placeholder.jpg' : 'storage/seller/profile_pix/'.$seller->image ?>
                                            <a href="{{ route('seller.details', ['id' => $seller->id]) }}">
                                                <img src="{{ asset($sellerImg) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            
                                        </div>
                                        <div class="product-detail text-center">
                                            <a href="{{ route('seller.details', ['id' => $seller->id]) }}">
                                                <h6 class="name h-100">{{ $seller->companyname ?? $seller->firstname.' '.$seller->lastname }}</h6>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
--}}

<!-- Newly Added Section Start -->
<section>
    <div class="title d-block">
        <h2 class="text-theme font-sm">Newly Added Properties</h2>
        <p>The Latest Drops You’ll Want in Your Cart</p>
    </div>
    <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
        @foreach($recentProducts as $product)
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
</section>
<!-- Newly Added Section End -->
@endsection
