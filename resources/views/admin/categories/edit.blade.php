@extends('admin.layouts.main', ['title' => 'Product Categories', 'activePage' => 'category'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit Category</h5>
                                <div class="right-options">
                                    <ul>
                                        <li>
                                            <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.categories') }}">
                                                <i class="fa fa-arrow-left"></i> Back</a>
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
                                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                            @endif

                            <div class="theme-form theme-form-2 mega-form">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="title" id="title" value="{{ $category->title ?? old('title') }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Level</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="level" id="level">
                                            <option value="">- - - Select - - -</option>
                                            <option value="1" @selected($category->level == 1)>First</option>
                                            <option value="2" @selected($category->level == 2)>Second</option>
                                            <option value="3" @selected($category->level == 3)>Third</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center" id="parent_level_2">
                                    <label class="form-label-title col-sm-3 mb-0">Parent</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="parent2">
                                            <option value="">- - - Select - - -</option>
                                            @foreach($categories as $cat)
                                                @if($cat->level == 2)
                                                    <option value="{{ $cat->id }}" @selected($category->parent == $cat->id)>{{ $cat->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center" id="parent_level_1">
                                    <label class="form-label-title col-sm-3 mb-0">Parent</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="parent1">
                                            <option value="">- - - Select - - -</option>
                                            @foreach($categories as $cat)
                                                @if($cat->level == 1)
                                                    <option value="{{ $cat->id }}" @selected($category->parent == $cat->id)>{{ $cat->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Icon</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="icon" id="icon">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description">{{ $category->description ?? old('description') }}</textarea>
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
            $('#parent_level_1').hide();
            $('#parent_level_2').hide();
            checkLevelParent($('#level').val())
            $('#level').change(function(){
                checkLevelParent($(this).val());
            });
            function checkLevelParent(catLevel) {
                if (catLevel == 1) {
                    $('#parent_level_1').hide('slow');
                    $('#parent1').removeAttr('name');
                    $('#parent1').removeAttr('required');
                    $('#parent_level_2').hide('slow');
                    $('#parent2').removeAttr('name');
                    $('#parent2').removeAttr('required');
                }
                if (catLevel == 2) {
                    $('#parent_level_2').hide('slow');
                    $('#parent2').removeAttr('name');
                    $('#parent2').removeAttr('required');
                    $('#parent_level_1').show('slow');
                    $('#parent1').attr('name', 'parent');
                    $('#parent1').attr('required', 'required');
                }
                if (catLevel == 3) {
                    $('#parent_level_1').hide('slow');
                    $('#parent1').removeAttr('name');
                    $('#parent1').removeAttr('required');
                    $('#parent_level_2').show('slow');
                    $('#parent2').attr('name', 'parent');
                    $('#parent2').attr('required', 'required');
                }
            }
        });
    </script>
@endpush