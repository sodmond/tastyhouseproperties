@extends('layouts.app', ['title' => 'Reviews', 'activePage' => 'user.reviews'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('user.layouts.sidebar', ['activePage' => 'user.reviews'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="product-tab">
                        <div class="title">
                            <h2>Reviews</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="table-responsive dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Reviews to Vendors</h3>
                                <button class="btn btn-sm theme-bg-color text-white">
                                    <a class="text-white" href="{{ route('user.reviews.new') }}">
                                        <i class="fa fa-plus-circle"></i> Add New
                                    </a>
                                </button>
                            </div>
                            <table class="table product-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td>
                                            <h6>{{ $review->seller->companyname ?? $review->seller->firstname.' '.$review->seller->lastname }}</h6>
                                        </td>
                                        <td>
                                            <input type="number" name="rating" id="rating" class="rating" data-clearable="" data-icon-lib="fa" data-active-icon="fa-star" data-inactive-icon="fa-star-o" data-readonly="" value="{{ $review->rating }}">
                                        </td>
                                        <td>
                                            <h6>{{ substr($review->comment, 0, 20) }}</h6>
                                        </td>
                                        <td class="edit-delete">
                                            <a href="{{ route('user.review', ['id' => $review->id]) }}"><i data-feather="eye" class="edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav class="custom-pagination">
                                {{ $reviews->appends($_GET)->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection