@extends('layouts.app', ['title' => 'User Profile', 'activePage' => 'user.profile'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
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
                                <h3>Profile Details</h3>
                                <button class="btn btn-sm theme-bg-color text-white"><a class="text-white" href="{{ route('user.profile.edit') }}">Edit Profile</a></button>
                                <button class="btn btn-sm theme-bg-color text-white"><a class="text-white" href="{{ route('user.profile.password') }}">Change Password</a></button>
                            </div>

                            <ul>
                                <li>
                                    <h5 class="fw-bold">First Name :</h5>
                                    <h5>{{ auth('web')->user()->firstname }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Last Name :</h5>
                                    <h5>{{ auth('web')->user()->lastname }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Email Address :</h5>
                                    <h5>{{ auth('web')->user()->email }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Phone :</h5>
                                    <h5>0{{ auth('web')->user()->phone }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Date Created :</h5>
                                    <h5>{{ auth('web')->user()->created_at }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Last Updated :</h5>
                                    <h5>{{ auth('web')->user()->updated_at }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection