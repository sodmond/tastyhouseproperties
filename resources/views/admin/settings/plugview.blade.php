@extends('admin.layouts.main', ['title' => 'Update Plugview Video', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Update Plugview Video</h5>
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
                                    <label class="form-label-title col-sm-3 mb-0">Default</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="default" id="default" required>
                                            <option value="">- - - Select - - -</option>
                                            <option value="mp4" @selected($plugview['default']->access_token == 'mp4')>MP4</option>
                                            <option value="youtube" @selected($plugview['default']->access_token == 'youtube')>Youtube</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Youtube Link</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="youtube" id="youtube" value="{{ $plugview['youtube']->access_token }}">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-top">
                                    <label class="form-label-title col-sm-3 mb-0">MP4 File</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="mp4" id="mp4">
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset('storage/'.$plugview['mp4']->access_token) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
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