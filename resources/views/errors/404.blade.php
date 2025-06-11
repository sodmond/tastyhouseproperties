<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['activePage' => 'error', 'title' => '404 Not Found'])

@section('content')
<section class="section-404 section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="image-404">
                    <img src="{{ asset('frontend/images/inner-page/404.png') }}" class="img-fluid blur-up lazyload" alt="">
                </div>
            </div>

            <div class="col-12">
                <div class="contain-404">
                    <h3 class="text-content">The page you are looking for could not be found. The link to this
                        address may be outdated or we may have moved it since you last bookmarked it.</h3>
                    <a href="{{ url('/') }}">
                        <button class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Back To Homepage</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 404 Section End -->
@endsection