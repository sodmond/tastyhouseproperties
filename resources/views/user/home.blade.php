@extends('layouts.app', ['title' => 'User Dashboard', 'activePage' => 'user.home'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('user.layouts.sidebar', ['activePage' => 'user.home'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                            <div class="dashboard-home">
                                <div class="title">
                                    <h2>My Dashboard</h2>
                                    <span class="title-leaf">
                                        &nbsp;
                                    </span>
                                </div>

                                <div class="dashboard-user-name">
                                    <h6 class="text-content">Hello, <b class="text-title">{{ auth('web')->user()->firstname.' '.auth('web')->user()->lastname }}</b></h6>
                                    <p class="text-content">From your My Account Dashboard you have the ability to
                                        view a snapshot of your recent account activity and update your account
                                        information. Select a link below to view or edit information.</p>
                                </div>

                                <div class="total-box">
                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('frontend/images/svg/order.svg') }}"
                                                    class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('frontend/images/svg/order.svg') }}" class="blur-up svg-theme-color lazyload"
                                                    alt="">
                                                <div class="total-detail">
                                                    <h5>Favorite Products</h5>
                                                    <h3>{{ number_format($wishlist->count()) }}</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('img/rating-rate.svg') }}"
                                                    class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('img/rating-rate.svg') }}" class="blur-up svg-theme-color lazyload"
                                                    alt="">
                                                <div class="total-detail">
                                                    <h5>Total Reviews</h5>
                                                    <h3>{{ number_format($reviews->count()) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-xxl-6">
                                        <div class="order-tab dashboard-bg-box">
                                            <div class="dashboard-title mb-4">
                                                <h3>Recent Favorite Products</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table product-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Images</th>
                                                            <th scope="col">Product Name</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">...</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php 
                                                            $favorites = $wishlist->get();
                                                            $wishlistCount = ($wishlist->count() <= 5) ? $wishlist->count() : 5 ; @endphp
                                                        @for($i=0; $i < $wishlistCount; $i++)
                                                        <tr>
                                                            <td class="product-image">
                                                                @php $thumbnail = json_decode($favorites[$i]->product->image)[0]; @endphp
                                                                <img src="{{ asset('storage/products/'.$favorites[$i]->product->seller_id.'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="">
                                                            </td>
                                                            <td>
                                                                <h6>{{ $favorites[$i]->product->title }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="theme-color fw-bold">
                                                                    {{ ($favorites[$i]->product->price_type == 'call_for_price') ? 'Call for Price' : $currency.number_format($favorites[$i]->price, 2) }}</h6>
                                                            </td>
                                                            <td class="edit-delete">
                                                                <a href="{{ route('product', ['slug' => $favorites[$i]->product->slug]) }}"><i data-feather="eye" class="edit"></i></a>
                                                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('{{'wishlistForm'.$favorites[$i]->id}}').submit()">
                                                                    <i data-feather="trash-2" class="delete"></i></a>
                                                                <form action="{{ route('user.wishlist.remove') }}" method="post" id="{{'wishlistForm'.$favorites[$i]->id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $favorites[$i]->id }}">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection