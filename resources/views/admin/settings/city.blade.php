@extends('admin.layouts.main', ['title' => isset($city) ? 'Edit City' : 'New City', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            @if(!isset($city))
            <!-- NEW CITY FORM -->
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Add New City</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.cities') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                                    <label class="form-label-title col-sm-3 mb-0">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">State</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">- - - Select - - -</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" @selected(old('state') == $state->id)>{{ ucwords($state->name) }}</option>
                                            @endforeach
                                        </select>
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
            <!-- Update City Details -->
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.city.update', ['id' => $city->id]) }}" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit City Details</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.cities') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                                    <label class="form-label-title col-sm-3 mb-0">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $city->name }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">State</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">- - - Select - - -</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" @selected($city->state_id == $state->id)>{{ ucwords($state->name) }}</option>
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
            @endif
        </div>
    </div>
</div>
@endsection