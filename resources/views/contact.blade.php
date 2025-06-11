<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Contact', 'activePage' => 'contact'])

@section('content')
<!-- Contact Box Section Start -->
<section class="contact-box-section mb-4">
    <div class="container-fluid-lg">
        <div class="row g-lg-5 g-3 mb-4">
            <div class="col-lg-6">
                <div class="left-sidebar-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="contact-image">
                                <img src="{{ asset('img/sign-in.png') }}"
                                    class="img-fluid blur-up lazyloaded" alt="">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="contact-title">
                                <h3>Get In Touch</h3>
                            </div>

                            <div class="contact-detail">
                                <div class="row g-4">
                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="contact-detail-box">
                                            <div class="contact-icon">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="contact-detail-title">
                                                <h4>Phone</h4>
                                            </div>

                                            <div class="contact-detail-contain">
                                                <p>+2349051802727</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="contact-detail-box">
                                            <div class="contact-icon">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="contact-detail-title">
                                                <h4>Email</h4>
                                            </div>

                                            <div class="contact-detail-contain">
                                                <p>support@tastyhousestores.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="title d-xxl-none d-block">
                    <h2>Contact Us</h2>
                </div>
                <form class="right-sidebar-box" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            @if (count($errors))
                                <div class="alert alert-danger">
                                    <strong class="text-danger">Whoops!</strong> Error validating data.<br>
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
                        </div>
                        <div class="col-xxl-6 col-lg-6 col-sm-6">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="firstname" class="form-label">First Name</label>
                                <div class="custom-input">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}"
                                        placeholder="Enter First Name">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-6 col-sm-6">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="lastname" class="form-label">Last Name</label>
                                <div class="custom-input">
                                    <input type="text" class="form-control" id="firstname" name="lastname" value="{{ old('lastname') }}"
                                        placeholder="Enter Last Name">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="custom-input">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter Email Address">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="custom-input">
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="Enter Your Phone Number" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                        this.value.slice(0, this.maxLength);">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="message" class="form-label">Message</label>
                                <div class="custom-textarea">
                                    <textarea class="form-control" id="message" name="message"
                                        placeholder="Enter Your Message" rows="6">{{ old('message') }}</textarea>
                                    <i class="fa-solid fa-message"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            {!! htmlFormSnippet() !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-animation btn-md fw-bold ms-auto w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Box Section End -->
@endsection