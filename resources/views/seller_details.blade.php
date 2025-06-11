@extends('layouts.app', ['title' => $seller->companyname ?? $seller->firstname.$seller->lastname, 'activePage' => 'vendors'])

@section('content')
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                <div class="left-box wow fadeInUp">
                    <div class="shop-left-sidebar">
                        <div class="vendor-detail-box">
                            <div class="vendor-name vendor-bottom">
                                <div class="vendor-logo">
                                    <img src="{{ asset('storage/seller/profile_pix/'.$seller->image) }}" alt="">
                                    <div>
                                        <h3 class="mb-2">{{ $seller->companyname ?? $seller->firstname.$seller->lastname }}</h3>
                                        @if ($seller->kyc_status == 1)
                                            <span class="text-success border-success px-2 py-1 rounded small">
                                                <i class="fa fa-check-circle"></i> Verified ID</span>
                                        @else
                                            <span class="text-danger border-danger px-2 py-1 rounded small">
                                                <i class="fa fa-times-circle"></i> Not Verified</span>
                                        @endif
                                    </div>
                                    <div class="product-rating vendor-rating">
                                        <ul class="rating">
                                            @php $rating = (count($seller->reviews) > 0) ? round($seller->reviews->sum('rating') / count($seller->reviews)) : 0; @endphp
                                            @for($i=1; $i <= 5; $i++)
                                                <li>
                                                    <i data-feather="star" class="{{ ($i <= $rating) ? 'fill' : '' }}"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span>({{ count($seller->reviews) }} Reviews)</span>
                                    </div>
                                </div>
                                <p class="mb-4">{{ $seller->bio }}</p>
                                <h5><i class="fa fa-map-marker-alt theme-color mb-4"></i> <strong>Location:</strong> <span class="text-content">
                                    @if(isset($seller->cityy->name) && isset($seller->sate->name))
                                        {{ $seller->cityy->name.', '.$seller->sate->name }}
                                    @endif
                                </span></h5>
                                <h5>
                                    <i class="fa fa-phone theme-color mb-4"></i> 
                                    <strong>Contact:</strong> 
                                    <?php $subscription = \App\Models\Subscription::where('seller_id', $seller->id)->where('type', 'general')->latest()->first(); ?>
                                    @if($subscription->end_date > date('Y-m-d'))
                                        <span class="text-content">+234{{ $seller->phone }}</span>
                                    @endif
                                </h5>
                            </div>

                            <div class="vendor-share">
                                <h5>Share :</h5>
                                <ul style="">
                                    <li>
                                        <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u='.url()->full() }}" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ 'https://x.com/intent/post?text='.$seller->companyname.'&url='.url()->full() }}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ 'https://www.linkedin.com/shareArticle/?mini=true&url='.url()->full().'&title='.$seller->companyname }}" target="_blank">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ 'https://wa.me/?text='.url()->full() }}" target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vendor-detail-box">
                            <h4>Reviews</h4>
                            <div class="product-section-box" style="margin-top:10px; margin-bottom:10px;">
                                <div class="review-box">
                                    <div class="review-people" style="padding-left:0px; border-left:0px;">
                                        @php $reviewsCount = (count($seller->reviews) < 5) ? count($seller->reviews) : 5; @endphp
                                        <ul class="review-list">
                                            @for($i=0; $i < $reviewsCount; $i++)
                                            @php $review = $seller->reviews[$i] @endphp
                                            <li>
                                                <div class="people-box">
                                                    <div class="people-comment">
                                                        <div class="people-name"><a href="javascript:void(0)"
                                                                class="name">{{ $review->user->firstname.' '.$review->user->lastname }}</a>
                                                            <div class="date-time">
                                                                <h6 class="text-content"> {{ date('M d, Y', strtotime($review->created_at)) }}
                                                                </h6>
                                                                <div class="product-rating">
                                                                    <ul class="rating">
                                                                        @for($i=1; $i <= 5; $i++)
                                                                            <li>
                                                                                <i data-feather="star" class="{{ ($i <= $review->rating) ? 'fill' : '' }}"></i>
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reply">
                                                            <p>{{ substr($review->comment, 0, 20) }}...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="pt-2" style="border-top:1px solid #EAEAEA;">
                                <a href="{{ route('vendor.reviews', ['id' => $seller->id]) }}">View all</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <div class="right-box">
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
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail text-center">
                                        <span class="span-name">{{ $product->category->title }}</span>
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
    </div>
</section>
@endsection