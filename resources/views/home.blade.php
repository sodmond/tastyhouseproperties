@extends('layouts.app', ['title' => 'Home', 'activePage' => 'home'])

@section('content')
<section class="home-section pt-2">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xl-8 ratio_65">
                <div class="home-contain h-100">
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
                    <div class="h-100">
                        <a href="{{ $adUrl }}" target="_blank">
                            <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 ratio_65">
                <div class="row g-4">
                    @php
                        $ad_medium = $adverts->where('slug', 'homepage-medium');
                        $num = 1;
                    @endphp
                    @foreach($ad_medium as $ad)
                        @php
                        $adImage = asset('storage/advert/'.$ad->image) ?? asset('img/adverts/ad_medium.png');
                        $buttonText = $ad->button_text ?? 'Contact';
                        $adUrl = $ad->url ?? '#';
                        if ($ad->end_date < date('Y-m-d')) {
                            $adImage = asset('img/adverts/ad_medium_'.$num.'.png');
                            $buttonText = 'Contact';
                            $adUrl = route('advertise');
                        }
                        @endphp
                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <a href="{{ $adUrl }}" target="_blank">
                                    <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                                </a>
                            </div>
                        </div>
                        @php $num++ @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Section End -->

<!-- Banner Section Start -->
<section class="banner-section ratio_60 wow fadeInUp">
    <div class="container-fluid-lg">
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
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="title title-flex">
                    <div>
                        <h2>Prime Products</h2>
                        <span class="title-leaf">
                            &nbsp;
                        </span>
                        <p>Shop our exclusive 'Prime Products' - featured items handpicked for you by our trusted vendors!</p>
                    </div>
                </div>

                <div class="section-b-space">
                    <div class="product-border border-row">
                        <?php $products = $primeProducts; ?>
                        <div class="product-box-slider product-wrapper no-arrow">
                            @for($i=0; $i < count($products); $i+=2)
                                <div>
                                    <div class="row m-0">
                                        @php $product = $products[$i]; @endphp
                                        <div class="col-12 px-0">
                                            <div class="product-box">
                                                <span class="product-badge">Prime</span>
                                                <div class="product-image">
                                                    @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                        <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <ul class="product-option justify-content-center">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View">
                                                            <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail text-center">
                                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                        <h6 class="name">{{ $product->title }}</h6>
                                                    </a>
                                                    <div class="product-rating review-rating justify-content-center">
                                                        <ul class="rating">
                                                            <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                                            @for($j=1; $j <= 5; $j++)
                                                                <li>
                                                                    <i data-feather="star" class="{{ ($j <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                        <span class="content-color">({{ $avg_rating }})</span>
                                                    </div>
                                                    <h5 class="sold text-content">
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
                                        @isset($products[$i+1])
                                            @php $product = $products[$i+1]; @endphp
                                            <div class="col-12 px-0">
                                                <div class="product-box">
                                                    <span class="product-badge">Prime</span>
                                                    <div class="product-image">
                                                        @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <ul class="product-option justify-content-center">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-detail text-center">
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <h6 class="name">{{ $product->title }}</h6>
                                                        </a>
                                                        <div class="product-rating review-rating justify-content-center">
                                                            <ul class="rating">
                                                                <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                                                @for($j=1; $j <= 5; $j++)
                                                                    <li>
                                                                        <i data-feather="star" class="{{ ($j <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            <span class="content-color">({{ $avg_rating }})</span>
                                                        </div>
                                                        <h5 class="sold text-content">
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
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Influencer Products Section Start -->
<section class="banner-section ratio_60 wow fadeInUp" style="padding-top:0;">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Influencer Products</h2>
            <span class="title-leaf">
                &nbsp;
            </span>
            <p>Curated Picks from Your Favorite Influencers</p>
        </div>
        <div class="banner-slider">
            @php
                $ad_influencer = $adverts->where('slug', 'influencer-products');
                $num = 1;
            @endphp
            @foreach($ad_influencer as $ad)
                @php
                $adImage = asset('storage/advert/'.$ad->image) ?? asset('img/adverts/ad_influencer_'.$num.'.jpg');
                $buttonText = $ad->button_text ?? 'Contact';
                $adUrl = $ad->url ?? '#';
                if ($ad->end_date < date('Y-m-d')) {
                    $adImage = asset('img/adverts/ad_influencer_'.$num.'.jpg');
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
    </div>
</section>
<!-- Influencer Products Section End -->

<section class="product-section">
    <div class="container-fluid-lg">
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
    </div>
</section>

<section class="product-section d-block d-sm-none" id="plugview">
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
</section>

<section class="product-section">
    <div class="container-fluid-lg">
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

                <div class="section-t-space">
                    @php 
                    $ad_landscape1 = $adverts->where('slug', 'homepage-landscape-1')->first();
                    $adImage = asset('storage/advert/'.$ad_landscape1->image) ?? asset('img/adverts/ad_landscape_1.jpg');
                    $buttonText = $ad_landscape1->button_text ?? 'Click here';
                    $adUrl = $ad_landscape1->url ?? '#';
                    if ($ad_landscape1->end_date < date('Y-m-d')) {
                        $adImage = asset('img/adverts/ad_landscape_1.jpg');
                        $buttonText = 'Contact';
                        $adUrl = route('advertise');
                    }
                    @endphp
                    <div class="banner-contain hover-effect" style="cursor:pointer;">
                        <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                        <a class="banner-details p-center banner-b-space w-100 text-center" href="{{ $adUrl }}">
                            <div class="py-3">
                                &nbsp;
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Celebs Gallery Section Start -->
<section class="banner-section ratio_60 wow fadeInUp">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>The Celebs Gallery</h2>
            <span class="title-leaf">
                &nbsp;
            </span>
            <p>Star Style Inspo, All in One Place</p>
        </div>
        <div class="banner-slider">
            @php
                $ad_celeb = $adverts->where('slug', 'celeb-gallery');
                $num = 1;
            @endphp
            @foreach($ad_celeb as $ad)
                @php
                $adImage = asset('storage/advert/'.$ad->image) ?? asset('img/adverts/ad_celeb_'.$num.'.jpg');
                $buttonText = $ad->button_text ?? 'Contact';
                $adUrl = $ad->url ?? '#';
                if ($ad->end_date < date('Y-m-d')) {
                    $adImage = asset('img/adverts/ad_celeb_'.$num.'.jpg');
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
    </div>
</section>
<!-- Celebs Gallery Section End -->

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="title d-block mt-4">
                    <div>
                        <h2>New In Store</h2>
                        <span class="title-leaf">
                            &nbsp;
                        </span>
                        <p>The Latest Drops You’ll Want in Your Cart</p>
                    </div>
                </div>

                <div class="wow fadeInUp">
                    <div class="product-border border-row">
                        <?php $products = $recentProducts->take(30); ?>
                        <div class="product-box-slider product-wrapper no-arrow">
                            @for($i=0; $i < count($products); $i+=3)
                                <div>
                                    <div class="row m-0">
                                        @php $product = $products[$i]; @endphp
                                        <div class="col-12 px-0">
                                            <div class="product-box">
                                                @if($product->prime_status == 1) <span class="product-badge">Prime</span> @endif
                                                <div class="product-image">
                                                    @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                        <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <ul class="product-option justify-content-center">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View">
                                                            <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail text-center">
                                                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                        <h6 class="name">{{ $product->title }}</h6>
                                                    </a>
                                                    <div class="product-rating review-rating justify-content-center">
                                                        <ul class="rating">
                                                            <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                                            @for($j=1; $j <= 5; $j++)
                                                                <li>
                                                                    <i data-feather="star" class="{{ ($j <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                        <span class="content-color">({{ $avg_rating }})</span>
                                                    </div>
                                                    <h5 class="sold text-content">
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
                                        @isset($products[$i+1])
                                            @php $product = $products[$i+1]; @endphp
                                            <div class="col-12 px-0">
                                                <div class="product-box">
                                                    @if($product->prime_status == 1) <span class="product-badge">Prime</span> @endif
                                                    <div class="product-image">
                                                        @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <ul class="product-option justify-content-center">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-detail text-center">
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <h6 class="name">{{ $product->title }}</h6>
                                                        </a>
                                                        <div class="product-rating review-rating justify-content-center">
                                                            <ul class="rating">
                                                                <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                                                @for($j=1; $j <= 5; $j++)
                                                                    <li>
                                                                        <i data-feather="star" class="{{ ($j <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            <span class="content-color">({{ $avg_rating }})</span>
                                                        </div>
                                                        <h5 class="sold text-content">
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
                                        @endisset

                                        @isset($products[$i+2])
                                            @php $product = $products[$i+2]; @endphp
                                            <div class="col-12 px-0">
                                                <div class="product-box">
                                                    @if($product->prime_status == 1) <span class="product-badge">Prime</span> @endif
                                                    <div class="product-image">
                                                        @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <ul class="product-option justify-content-center">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-detail text-center">
                                                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <h6 class="name">{{ $product->title }}</h6>
                                                        </a>
                                                        <div class="product-rating review-rating justify-content-center">
                                                            <ul class="rating">
                                                                <?php $avg_rating = avgRating($product->seller->reviews); ?>
                                                                @for($j=1; $j <= 5; $j++)
                                                                    <li>
                                                                        <i data-feather="star" class="{{ ($j <= round($avg_rating)) ? 'fill' : '' }}"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            <span class="content-color">({{ $avg_rating }})</span>
                                                        </div>
                                                        <h5 class="sold text-content">
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
                                        @endisset
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="">
                    @php 
                    $ad_landscape2 = $adverts->where('slug', 'homepage-landscape-2')->first();
                    $adImage = asset('storage/advert/'.$ad_landscape2->image) ?? asset('img/adverts/ad_landscape_2.jpg');
                    $buttonText = $ad_landscape2->button_text ?? 'Click here';
                    $adUrl = $ad_landscape2->url ?? '#';
                    if ($ad_landscape2->end_date < date('Y-m-d')) {
                        $adImage = asset('img/adverts/ad_landscape_2.jpg');
                        $buttonText = 'Contact';
                        $adUrl = route('advertise');
                    }
                    @endphp
                    <div class="banner-contain hover-effect" style="cursor:pointer;">
                        <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                        <a class="banner-details p-center banner-b-space w-100 text-center" href="{{ $adUrl }}">
                            <div class="py-3">
                                &nbsp;
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Section Starts -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title title-flex-2">
            <h2>Services</h2>
            <ul class="nav nav-tabs tab-style-2" id="myTab">
                <li class="nav-item">
                    <a class="nav-link btn active" href="{{ route('shop.category', ['id' => 346, 'slug' => 'services']) }}">
                        <small>View All</small></a>
                </li>
            </ul>
        </div>

        <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
            <?php $products = $recentProducts->whereIn('product_category_id', $serviceCats)->take(8); ?>
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
    </div>
</section>
<!-- Service Section Ends -->

<!-- Automobile Section Starts -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title title-flex-2">
            <h2>Automobile</h2>
            <ul class="nav nav-tabs tab-style-2" id="myTab">
                <li class="nav-item">
                    <a class="nav-link btn active" href="{{ route('shop.category', ['id' => 375, 'slug' => 'vehicle']) }}">
                        <small>View All</small></a>
                </li>
            </ul>
        </div>

        <div class="row g-sm-4 g-3 row-cols-xxl-5 row-cols-xl-5 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
            <?php $products = $recentProducts->whereIn('product_category_id', $vehicleCats)->take(6); ?>
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
    </div>
</section>
<!-- Automobile Section Ends -->

<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12">
                <div class="title">
                    <h2>Recent Blog</h2>
                    <span class="title-leaf">
                        &nbsp;
                    </span>
                    <p>Stay updated with our 'Recent Blog' – insightful articles and tips to enhance your shopping experience!</p>
                </div>

                <div class="slider-3-blog ratio_65 no-arrow product-wrapper">
                    @foreach($recentPost as $post)
                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="{{ route('blog.details', ['id' => $post->id, 'slug' => $post->slug]) }}" class="blog-image">
                                    <img src="{{ asset('storage/blog/image/'.$post->image) }}" class="bg-img blur-up lazyload"
                                        alt="">
                                </a>
                            </div>

                            <a href="{{ route('blog.details', ['id' => $post->id, 'slug' => $post->slug]) }}" class="blog-detail">
                                <h6>{{ date('d M, Y', strtotime($post->published_at)) }}</h6>
                                <h5>{{ $post->title }}</h5>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section Start -->
<section class="newsletter-section section-b-space">
    <div class="container-fluid-lg">
        <div class="newsletter-box newsletter-box-2">
            <div class="newsletter-contain py-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                            <form class="newsletter-detail" id="newsletterForm">
                                <h2>Join our newsletter and get...</h2>
                                <h5>First access to best discount deals</h5>
                                <div class="input-box">
                                    <input type="email" class="form-control" id="newsletter_email_1"
                                        placeholder="Enter Your Email" required>
                                    <i class="fa-solid fa-envelope arrow"></i>
                                    <button type="submit" class="sub-btn  btn-animation">
                                        <span class="d-sm-block d-none">Subscribe</span>
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter Section End -->
@endsection
