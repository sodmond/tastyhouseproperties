<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['activePage' => 'error', 'title' => '503 Maintenance Service'])

@section('content')
<section class="section-404 section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="image-404">
                    <img src="{{ asset('frontend/images/inner-page/503.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                </div>
            </div>

            <div class="col-12">
                <div class="contain-404">
                    <h3 class="text-content">The website is under maintenance, our engineers are currently working to get the website to work more efficienctly. We will be back soon.</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection