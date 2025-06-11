@extends('admin.layouts.auth', ['title' => 'Reset Password'])

@section('content')
<div class="log-in-box">
    <div class="log-in-title">
        <h3>Admin Portal</h3>
        <h4>Reset Password</h4>
    </div>

    <div class="input-box">
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
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="row g-4" method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ $email ?? old('email') }}">
                    <label for="email">Email Address</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="password" class="form-control" name="password" id="password" autocomplete="new-password">
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="password" class="form-control" name="password_confirmation" id="password-confirm" autocomplete="new-password">
                    <label for="password">Confirm Password</label>
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-animation w-100 justify-content-center">Reset</button>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted mb-0">Back to <a href="{{ route('admin.login') }}" class="text-dark ml-1"><b>Log in</b></a></p>
            </div> <!-- end col -->
        </div>
    </div>

</div>
@endsection