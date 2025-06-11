@extends('layouts.app', ['title' => 'User Wishlist', 'activePage' => 'user.wishlist'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('user.layouts.sidebar', ['activePage' => 'user.wishlist'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                            <div class="dashboard-home">
                                <div class="title">
                                    <h2>Wishlist</h2>
                                    <span class="title-leaf">
                                        &nbsp;
                                    </span>
                                </div>

                                <div class="row g-4">

                                    <div class="col-xxl-6">
                                        <div class="table-responsive dashboard-bg-box">
                                            <div class="dashboard-title mb-4">
                                                <h3>Favourite Products</h3>
                                            </div>

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
                                                    @foreach($wishlist as $item)
                                                    <tr>
                                                        <td class="product-image">
                                                            @php $thumbnail = json_decode($item->product->image)[0]; @endphp
                                                            <img src="{{ asset('storage/products/'.$item->product->seller_id.'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="">
                                                        </td>
                                                        <td>
                                                            <h6>{{ $item->product->title }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="theme-color fw-bold">
                                                                {{ ($item->product->price_type == 'call_for_price') ? 'Call for Price' : $currency.number_format($item->product->price, 2) }}</h6>
                                                        </td>
                                                        <td class="edit-delete">
                                                            <a href="{{ route('product', ['slug' => $item->product->slug]) }}"><i data-feather="eye" class="edit"></i></a>
                                                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('{{'wishlistForm'.$item->id}}').submit()">
                                                                <i data-feather="trash-2" class="delete"></i></a>
                                                            <form action="{{ route('user.wishlist.remove') }}" method="post" id="{{'wishlistForm'.$item->id}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <nav class="custom-pagination">
                                                {{ $wishlist->appends($_GET)->links() }}
                                            </nav>
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