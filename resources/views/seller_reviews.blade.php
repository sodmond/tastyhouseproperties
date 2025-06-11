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
                                    <img src="{{ asset('storage/seller/profile_pix/'.$seller->image) }}" alt="" style="cursor:pointer"
                                        onclick="window.location.href='{{ route('seller.details', ['id' => $seller->id]) }}'">
                                    <div>
                                        <h3 class="mb-2" onclick="window.location.href='{{ route('seller.details', ['id' => $seller->id]) }}'" style="cursor:pointer">
                                            {{ $seller->companyname ?? $seller->firstname.' '.$seller->lastname }}</h3>
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
                                <h5><i class="fa fa-phone theme-color mb-4"></i> <strong>Contact:</strong> <span class="text-content">+234{{ $seller->phone }}</span></h5>
                            </div>

                            <div class="vendor-share">
                                <h5>Share :</h5>
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <div class="right-box">
                    <div class="product-section-box">
                        <div class="review-box">
                            <div class="review-people" style="padding-left:0px; border-left:0px;">
                                <ul class="review-list">
                                    @foreach($reviews as $review)
                                    <li>
                                        <div class="people-box">
                                            {{--<div>
                                                <div class="people-image people-text">
                                                    @php $profilepix = asset(empty($review->user->image) ? 'img/user-icon.png' : 'storage/user/profile_pix/'.$review->user->image ); @endphp
                                                    <img alt="user" class="img-fluid" src="{{ $profilepix }}">
                                                </div>
                                            </div>--}}
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
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <nav class="custom-pagination">
                        {{ $reviews->appends($_GET)->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection