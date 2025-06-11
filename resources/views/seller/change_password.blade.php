@extends('layouts.app', ['title' => 'Change Password', 'activePage' => 'seller.profile'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.profile'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>Account Password</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Change Password</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('seller.profile') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
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
                                <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('success') }}</div>
                            @endif

                            <form action="" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="current-password" name="old_password" placeholder="Current Password">
                                            <label for="current-password">Current Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                            <label for="password">New Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Confirm Password">
                                            <label for="confirm-password">Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
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