<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['activePage' => 'error', 'title' => '500 Server Error'])

@section('content')
<section class="section-404 section-lg-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="image-404">
                    <img src="{{ asset('frontend/images/inner-page/500.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                </div>
            </div>

            <div class="col-12">
                <div class="contain-404">
                    <h3 class="text-content">The website ran into a problem, Please try again or contact the website administrator if the problem persist</h3>
                    <a href="{{ route('contact') }}">
                        <button class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Contact Us</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection