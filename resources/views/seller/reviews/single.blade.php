@extends('layouts.app', ['title' => 'Review', 'activePage' => 'seller.reviews'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.reviews'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>Review</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Review Details</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('seller.reviews') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
                            </div>

                            @if (count($errors))
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Error validating data.<br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('success') }}</div>
                            @endif

                            <div>
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input class="form-control" value="{{ $review->user->firstname.' '.$review->user->lastname }}" readonly>
                                            <label>User</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <input type="number" class="rating" data-clearable="" data-icon-lib="fa" data-active-icon="fa-star" data-inactive-icon="fa-star-o" data-readonly="" value="{{ $review->rating }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <textarea class="form-control" style="min-height:150px;" readonly>{{ $review->comment }}</textarea>
                                            <label for="description">Comment</label>
                                        </div>
                                    </div>
                                    <div class="col mb-4 pt-3" style="border-top:1px solid #dcdcdc;">
                                        <div class="fs-5">Product Image</div>
                                        <div class="row">
                                            @php $images = json_decode($review->images) ?? []; @endphp
                                            @foreach ($images as $image)
                                                <div class="col-md-4">
                                                    <img src="{{ asset('storage/reviews/'.$image) }}" alt="">
                                                </div>
                                            @endforeach
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
<input type="hidden" id="getStateCitiesLink" value="{{ url('/get-state-city') }}">
<div id="image_add" style="display: none;">
    <div class="row mt-4">
        <div class="col-8">
            <div class="form-floating theme-form-floating">
                <input type="file" class="form-control" id="image" name="image[]" required>
                <label for="image">Select Image</label>
            </div>
        </div>
        <div class="col-4">
            <a class="btn btn-sm btn-link remove_field text-danger" href="#">Remove Image</a>
        </div>
    </div>
</div>
@endsection