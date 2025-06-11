@extends('admin.layouts.main', ['title' => 'Edit Package', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.subpack.update', ['id' => $package->id]) }}" method="POST" id="catForm">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit Package Details</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.subpacks') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                                    <label class="form-label-title col-sm-3 mb-0">Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $package->title }}" required readonly>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">- - - Select - - -</option>
                                            <option value="general" @selected($package->type == 'general')>General</option>
                                            <option value="prime" @selected($package->type == 'prime')>Prime</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Amount</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="amount" id="amount" value="{{ $package->amount }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Duration</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="duration" id="duration" value="{{ $package->duration }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description">{{ $package->description }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="status" required> 
                                            <option value="1" @selected($package->status == 1)>Active</option>
                                            <option value="0" @selected($package->status == 0)>Inactive</option>
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
        </div>
    </div>
</div>
@endsection