<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['activePage' => 'error', 'title' => '419 Page Expired'])

@section('content')
<section class="section-404 section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="image-404">
                    <img src="{{ asset('frontend/images/inner-page/419.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                </div>
            </div>

            <div class="col-12">
                <div class="contain-404">
                    <h3 class="text-content">The page you are looking for has expired. Please click the button below to go back to previous page or reload.</h3>
                    <button onclick="window.location.reload();" 
                        class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Reload Page</button>
                    <button onclick="window.history.back();" 
                        class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Back to Previous Page</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection