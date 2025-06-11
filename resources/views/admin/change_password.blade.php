@extends('admin.layouts.main', ['title' => 'Change Password', 'activePage' => 'account'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.profile.password.update') }}" method="POST">
                        <div class="card-body">
                            <div class="card-header-2">
                                <h5>Change Password</h5>
                            </div>

                            @if (count($errors))
                                <div class="alert alert-success">
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

                            <div class="theme-form theme-form-2 mega-form">
                                @method('put')
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Current Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="current-password" name="old_password">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="confirm-password" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-submit-button">
                            <button class="btn btn-animation ms-auto" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection