@extends('layouts.app', ['title' => 'Vendor Profile', 'activePage' => 'seller.profile'])

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
                            <h2>My Profile</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        @if(!auth('seller')->user()->kyc_status)
                        <div class="profile-tab dashboard-bg-box bg-success text-white">
                            <div class="row">
                                <div class="col-md-auto">
                                    <i data-feather="check-circle"></i>
                                </div>
                                <div class="col-md-9">
                                    @if(auth('seller')->user()->firstname != '' && auth('seller')->user()->lastname != '' && auth('seller')->user()->image != ''
                                        && auth('seller')->user()->address != '' && auth('seller')->user()->city != '' && auth('seller')->user()->state != ''
                                        && auth('seller')->user()->zip != '' && auth('seller')->user()->dob != '' && auth('seller')->user()->gender != '')
                                        <span class="mb-3">Your account has not been verified yet, click the button below to verify your NIN.</span>
                                        <button type="button" class="btn btn-white" id="sellerVerifyBtn">Verify NIN</button>
                                    @else
                                        <span>Your account has not been verified yet, please complete your profile details below.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Profile Details</h3>
                                <button class="btn btn-sm theme-bg-color text-white"><a class="text-white" href="{{ route('seller.profile.edit') }}">Edit Profile</a></button>
                                <button class="btn btn-sm theme-bg-color text-white"><a class="text-white" href="{{ route('seller.profile.password') }}">Change Password</a></button>
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

                            <ul>
                                <li>
                                    <h5 class="fw-bold">Account Status :</h5>
                                    <h5>
                                        @if(auth('seller')->user()->kyc_status)
                                            <span class="bg-success px-2 py-1 text-white rounded"><i class="fa fa-check-circle"></i> Verified</span>
                                        @else
                                            <span class="bg-danger px-2 py-1 text-white rounded"><i class="fa fa-times-cirlce"></i> Not Verified</span>
                                        @endif
                                    </h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">First Name :</h5>
                                    <h5>{{ auth('seller')->user()->firstname }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Last Name :</h5>
                                    <h5>{{ auth('seller')->user()->lastname }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Company Name :</h5>
                                    <h5>{{ auth('seller')->user()->companyname }}</h5>
                                </li>
                                <li>
                                    <h5 class="fw-bold">Email Address :</h5>
                                    <h5>{{ auth('seller')->user()->email }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Phone :</h5>
                                    <h5>0{{ auth('seller')->user()->phone }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Date of Birth :</h5>
                                    <h5>{{ auth('seller')->user()->dob }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Gender :</h5>
                                    <h5>{{ ucwords(auth('seller')->user()->gender) }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Company Name :</h5>
                                    <h5>{{ auth('seller')->user()->companyname }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Address :</h5>
                                    <h5>{{ auth('seller')->user()->address }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">City :</h5>
                                    <h5>{{ (!empty(auth('seller')->user()->city)) ? ucwords(\App\Models\City::find(auth('seller')->user()->city)->name) : '' }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">State :</h5>
                                    <h5>{{ (!empty(auth('seller')->user()->state)) ? ucwords(\App\Models\State::find(auth('seller')->user()->state)->name) : '' }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Zip :</h5>
                                    <h5>{{ auth('seller')->user()->zip }}</h5>
                                </li>

                                <li>
                                    <h5 class="fw-bold">Bio :</h5>
                                    <h5>{{ auth('seller')->user()->bio }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" id="verifyBox" tabindex="-1" aria-labelledby="verifyBoxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('seller.profile.verify') }}" method="POST">
            <div class="modal-header">
                <h4 class="modal-title">Verify Your NIN</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="nin" class="form-label">National Identification Number</label>
                    <input type="number" class="form-control" id="nin" name="nin" placeholder="Enter NIN here..." required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>  
@endsection

@push('custom-script')
    <script>
        $('#sellerVerifyBtn').on('click', function(e){
            e.preventDefault();
            $('#verifyBox').modal('show');
        });
    </script>
@endpush