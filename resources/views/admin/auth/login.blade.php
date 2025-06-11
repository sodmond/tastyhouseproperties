@extends('admin.layouts.auth', ['title' => 'Login'])

@section('content')
<div class="log-in-box">
    <div class="log-in-title">
        <h3>Admin Portal</h3>
        <h4>Log In Your Account</h4>
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
        <form class="row g-4" method="POST" action="">
            @csrf
            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                    <label for="email">Email Address</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="col-12">
                <div class="forgot-box">
                    <div class="form-check ps-0 m-0 remember-box">
                        <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                    </div>
                    @if (Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="forgot-password">Forgot Password?</a>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-animation w-100 justify-content-center">Log In</button>
            </div>
        </form>
    </div>

</div>
@endsection
