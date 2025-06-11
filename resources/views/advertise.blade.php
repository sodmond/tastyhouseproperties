<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Advertise', 'activePage' => 'advertise'])

@section('content')
<!-- Contact Box Section Start -->
<section class="contact-box-section mb-4">
    <div class="container-fluid-lg">
        <div class="row g-lg-5 g-3 mb-4">
            <div class="col-lg-6">
                <div class="left-sidebar-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="contact-title">
                                <h3>Advertise With Us at Tastyhouse Stores!</h3>
                            </div>

                            <div>
                                <p>At Tastyhouse Stores, we offer a unique opportunity for brands to reach a diverse and engaged audience through targeted advertising. Whether you're looking to promote a product, service, or special offer, we have various ad placement options tailored to fit your brand’s needs.</p>
                                <h4 class="my-4 fw-bold">Why Advertise With Us?</h4>
                                <ul class="th-list">
                                    <li><strong>Reach a Targeted Audience:</strong> Our marketplace attracts a wide range of shoppers who are already looking for quality products, giving you direct access to potential customers who are actively engaged and ready to purchase.</li>
                                    <li><strong>Flexible Ad Spots:</strong> We offer a variety of ad placement options, including banner ads, featured product listings, email marketing, and social media shoutouts. You can choose the best fit for your brand's goals.</li>
                                    <li><strong>Affordable and Effective:</strong> With our zero-commission model and affordable advertising rates, your brand gets the maximum exposure without breaking the bank.</li>
                                    <li><strong>Engage with a Community:</strong> Tastyhouse Stores is built on trust, and our customers trust the brands we feature. By advertising with us, you're aligning with a platform that values authenticity and customer satisfaction.</li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="my-4 fw-bold">How to Get Started</h4>
                                <p>It's simple to start advertising with us! Just fill out the form below, and our team will get in touch with you to discuss the best advertising options for your brand. Whether you're looking for a one-time campaign or ongoing exposure, we’ve got the perfect solution for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="title d-xxl-none d-block">
                    <h3>Fill the form below.</h3>
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
                        <div class="col-xxl-12 col-lg-12 col-sm-12">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="name" class="form-label">Name</label>
                                <div class="custom-input">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Enter Full Name">
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
                                <label for="banner" class="form-label">Banner Preference</label>
                                <div class="custom-input">
                                    <select class="form-control" id="banner" name="banner">
                                        <option value="">- - Select a Banner Size - -</option>
                                        @foreach ($adverts as $ad)
                                            <option value="{{ $ad->title }}" @selected( old('banner') == $ad->title )>{{ ucwords($ad->title).' | '.$ad->width.'x'.$ad->height.'px' }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa-solid fa-images"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                            <div class="mb-md-4 mb-3 custom-form">
                                <label for="duration" class="form-label">Duration</label>
                                <div class="custom-input">
                                    <select class="form-control" id="duration" name="duration">
                                        <option value="">- - Select a Preferred Duration - -</option>
                                        <option value="7 days" @selected( old('duration') == '7 days' )>7 Days</option>
                                        <option value="1 month" @selected( old('duration') == '1 Month' )>1 Month</option>
                                        <option value="3 months" @selected( old('duration') == '3 months' )>3 Months</option>
                                        <option value="6 months" @selected( old('duration') == '6 months' )>6 Months</option>
                                        <option value="1 year" @selected( old('duration') == '1 year' )>1 Year</option>
                                    </select>
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            {!! htmlFormSnippet() !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-animation btn-md fw-bold ms-auto w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Box Section End -->
@endsection