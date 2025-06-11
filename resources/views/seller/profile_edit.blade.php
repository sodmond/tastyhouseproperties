@extends('layouts.app', ['title' => 'Edit Profile', 'activePage' => 'seller.profile'])

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

                        @if(auth('seller')->user()->firstname != '' && auth('seller')->user()->lastname != '' && auth('seller')->user()->image != ''
                                        && auth('seller')->user()->address != '' && auth('seller')->user()->city != '' && auth('seller')->user()->state != ''
                                        && auth('seller')->user()->zip != '' && auth('seller')->user()->dob != '' && auth('seller')->user()->gender != '' && auth('seller')->user()->kyc_status == false)
                        <div class="profile-tab dashboard-bg-box bg-success text-white">
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="{{ route('seller.profile') }}" class="btn btn-white">Proceed to Verify NIN</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Update Business Logo</h3>
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

                            <form action="{{ route('seller.profile.update.image') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(auth('seller')->user()->image == '')
                                <div class="alert alert-info small"><strong><i class="fa fa-info-circle"></i></strong> The business logo is mandatory to proceed to the next section.</div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                @php $profilepix = asset(empty(auth('seller')->user()->image) ? 'img/user-icon.png' : 'storage/seller/profile_pix/'.auth('seller')->user()->image ); @endphp
                                                <img src="{{ $profilepix }}" class="img-fluid" alt="Profile Picture" style="max-width:150px;">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-floating theme-form-floating mb-4">
                                                    <input type="file" class="form-control" id="image" name="image" placeholder="First Name">
                                                    <label for="image">Select Image</label>
                                                    <small class="text-primary">Allowed images; .jpg, .png, .jpeg | Max: 1MB | Min Width/Height: 300px </small>
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

                            <form action="{{ route('seller.profile.update') }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ auth('seller')->user()->firstname }}" required>
                                            <label for="firstname">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ auth('seller')->user()->lastname }}" required>
                                            <label for="lastname">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="Email Address" value="{{ auth('seller')->user()->email }}" readonly>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ auth('seller')->user()->phone }}" required>
                                            <label for="phone">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name" value="{{ auth('seller')->user()->companyname }}">
                                            <label for="companyname">Company Name (Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="{{ auth('seller')->user()->dob }}" required>
                                            <label for="dob">Date of Birth</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="">- - - Select - - -</option>
                                                <option value="male" @selected(auth('seller')->user()->gender == 'male')>Male</option>
                                                <option value="female" @selected(auth('seller')->user()->gender == 'female')>Female</option>
                                            </select>
                                            <label for="gender">Gender</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ auth('seller')->user()->address }}" required>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" name="state" id="state" required>
                                                <option value="">State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{ (auth('seller')->user()->state == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" name="city" id="city" required>
                                                <option value="">City</option>
                                                @if ($cities->count() > 0)
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}" {{ ($city->id == auth('seller')->user()->city) ? 'selected' : '' }}>{{ $city->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="zip" name="zip" placeholder="zip" value="{{ auth('seller')->user()->zip }}" required>
                                            <label for="zip">Zip Code</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <textarea class="form-control" name="bio" id="bio" style="min-height:150px;">{{ auth('seller')->user()->bio }}</textarea>
                                            <label for="bio">Bio</label>
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
<input type="hidden" id="getStateCitiesLink" value="{{ url('/get-state-city') }}">
@endsection

@push('custom-script')
    <script>
        $(document).ready(function(){
            $('#state').change(function() {
                let state_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: $('#getStateCitiesLink').val() + '/' + state_id,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            let cities = '<option value="">- - - Select City</option>';
                            data.cities.forEach(element => {
                                cities += '<option value="' + element.id + '">' + element.name + '</option>';
                            });
                            $('#city').html(cities);
                        }
                    }
                });
            });
        });
    </script>
@endpush