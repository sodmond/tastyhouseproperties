@extends('layouts.app', ['title' => 'Vendor Reset Password', 'activePage' => 'seller.login'])

@section('content')
<section class="log-in-section background-image-2 section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('img/sign-in.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title mb-4">
                        <h3>Reset Password</h3>
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="row g-4" method="POST" action="{{ route('seller.password.email') }}">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating theme-form-floating log-in-form">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-animation w-100 justify-content-center" type="submit">
                                    Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>

                    <div class="other-log-in">
                        <h6> * </h6>
                    </div>

                    <div class="sign-up-box">
                        <h4>Remember Your Password?</h4>
                        <a href="{{ route('seller.login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection