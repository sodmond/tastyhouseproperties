@extends('layouts.app', ['title' => 'Edit Profile', 'activePage' => 'user.profile'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('user.layouts.sidebar', ['activePage' => 'user.profile'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>My Profile</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Update Profile Picture</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('user.profile') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
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
                                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('user.profile.update.image') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                @php $profilepix = asset(empty(auth('web')->user()->image) ? 'img/user-icon.png' : 'storage/user/profile_pix/'.auth('web')->user()->image ); @endphp
                                                <img src="{{ $profilepix }}" class="img-fluid" alt="Profile Picture" style="max-width:150px;">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-floating theme-form-floating mb-4">
                                                    <input type="file" class="form-control" id="image" name="image" placeholder="First Name">
                                                    <label for="image">Select Image</label>
                                                    <small class="text-primary">Allowed images; .jpg, .png, .jpeg | Max: 1MB | Min Width/Height: 300px</small>
                                                </div>
                                                <button type="submit" class="btn btn-sm theme-bg-color text-white">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Edit Profile Details</h3>
                            </div>

                            <form action="{{ route('user.profile.update') }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ auth('web')->user()->firstname }}" required>
                                            <label for="firstname">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ auth('web')->user()->lastname }}" required>
                                            <label for="lastname">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="Email Address" value="{{ auth('web')->user()->email }}" readonly>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ auth('web')->user()->phone }}" required>
                                            <label for="phone">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm theme-bg-color text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection