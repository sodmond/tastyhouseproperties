@extends('layouts.app', ['title' => 'Vendor Registration', 'activePage' => 'seller.register'])

@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-5 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('img/sign-up.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-6 col-xl-6 col-lg-7 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h3>Create New Account</h3>
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
                        <form class="row g-4" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname') }}">
                                    <label for="firstname">Firstname</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
                                    <label for="lastname">Lastname</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                    <label for="email">Email Address</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="forgot-box">
                                    <div class="form-check ps-0 m-0 remember-box">
                                        <input class="checkbox_animated check-box" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">I agree with
                                            <span>Terms</span> and <span>Privacy</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                {!! htmlFormSnippet() !!}
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-animation w-100" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>

                    <div class="other-log-in">
                        <h6>*</h6>
                    </div>

                    {{--<div class="log-in-button">
                        <ul>
                            <li>
                                <a href="https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin"
                                    class="btn google-button w-100">
                                    <img src="{{ asset('frontend/images/inner-page/google.png') }}" class="blur-up lazyload"
                                        alt="">
                                    Sign up with Google
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/" class="btn google-button w-100">
                                    <img src="{{ asset('frontend/images/inner-page/facebook.png') }}" class="blur-up lazyload"
                                        alt=""> Sign up with Facebook
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="other-log-in">
                        <h6></h6>
                    </div>--}}

                    <div class="sign-up-box">
                        <h4>Already have an account?</h4>
                        <a href="{{ route('seller.login') }}">Log In</a>
                    </div>
                </div>
            </div>

            <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
        </div>
    </div>
</section>
@endsection
