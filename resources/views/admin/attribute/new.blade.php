@extends('admin.layouts.main', ['title' => 'New Attribute', 'activePage' => 'attributes'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="" method="POST" id="catForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>New Attribute</h5>
                                <form class="d-inline-flex">
                                    <a href="{{ route('admin.attributes') }}" class="align-items-center btn btn-theme d-flex">
                                        <i class="ri-list-check-2"></i> All Attributes
                                    </a>
                                </form>
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
                                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                            @endif

                            <div class="theme-form theme-form-2 mega-form">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center" id="categories_div">
                                    <label class="form-label-title col-sm-3 mb-0">Categories</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="categories" name="categories[]" multiple="multiple" required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('categories') == $category->id)>{{ ucwords(strtolower($category->title . (($category->parent != '') ? ' ( '.$all_cats[$category->parent]->title.' )' : '') )) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Values<br>
                                        <small class="text-info">(Enter multiple values separated with commas)</small></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="values" id="values" rows="5" required>{{ old('values') }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Option Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="option_type" name="option_type" required>
                                            <option value="">- - - Select - - -</option>
                                            <option value="single" @selected(old('option_type') == 'single')>Single</option>
                                            <option value="multiple" @selected(old('option_type') == 'multiple')>Multiple</option>
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
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
    <script>
        $(document).ready(function(){
            $('#categories').select2();
        });
    </script>
@endpush