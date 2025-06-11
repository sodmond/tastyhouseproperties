@extends('admin.layouts.main', ['title' => isset($admin) ? 'Edit Admin' : 'New Admin', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            @if(!isset($admin))
            <!-- NEW ADMIN FORM -->
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.admin.new') }}" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>New Administrator</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.home') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                        </li>
                                    </ul>
                                </div>
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

                            <div class="theme-form theme-form-2 mega-form">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Firstname</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Lastname</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="">- - - Select - - -</option>
                                            @foreach($adminRoles as $role)
                                                <option value="{{ $role->id }}" @selected(old('role') == $role->id)>{{ ucwords($role->title) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password_confirmation" id="confirm-password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-submit-button">
                                <button class="btn btn-animation ms-auto" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- Update Admin Details -->
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.admin.update', ['id' => $admin->id]) }}" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit Admin Details</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.home') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                        </li>
                                    </ul>
                                </div>
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

                            <div class="theme-form theme-form-2 mega-form">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Firstname</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="firstname" id="firstname" value="{{ $admin->firstname }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Lastname</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="lastname" id="lastname" value="{{ $admin->lastname }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $admin->email }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="">- - - Select - - -</option>
                                            @foreach($adminRoles as $role)
                                                <option value="{{ $role->id }}" @selected($admin->role == $role->id)>{{ ucwords($role->title) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-submit-button">
                                <button class="btn btn-animation ms-auto" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Change Admin Password -->
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.admin.password', ['id' => $admin->id]) }}" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Change Password</h5>
                            </div>
                            <div class="theme-form theme-form-2 mega-form">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">New Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password_confirmation" id="confirm-password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-submit-button">
                                <button class="btn btn-animation ms-auto" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection