<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Verify Email Address', 'activePage' => 'verify'])

@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto align-content-center">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h3>{{ __('Verify Your Email Address') }}</h3>
                        <h4></h4>
                    </div>

                    <div class="input-box">
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
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline theme-color" style="display:initial;">
                                {{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('img/sign-in.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
