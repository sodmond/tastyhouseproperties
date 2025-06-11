@extends('admin.layouts.main', ['title' => 'Edit Advert', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.settings.advert.update', ['id' => $advert->id]) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit Advert Details</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-theme" href="{{ route('admin.settings.adverts') }}"><i class="fa fa-arrow-left"></i> Back</a>
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
                                        <input class="form-control" type="text" name="title" id="name" value="{{ $advert->title }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Width</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="width" id="width" value="{{ $advert->width }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Height</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="height" id="height" value="{{ $advert->height }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Cost</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="cost" id="amount" value="{{ $advert->cost }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="image" id="image">
                                        @if(!empty($advert->image))
                                        <a href="{{ asset('storage/advert/'.$advert->image) }}" target="_blank">
                                            <button class="btn btn-dark btn-sm my-2" type="button">View Image</button>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">URL</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="url" id="url">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Button Text</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="button_text" id="button_text">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Start Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $advert->start_date }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">End Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $advert->end_date }}" required>
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