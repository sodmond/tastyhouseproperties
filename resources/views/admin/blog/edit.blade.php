@extends('admin.layouts.main', ['title' => 'Edit Article', 'activePage' => 'blog'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 m-auto">
                    <form class="card" action="{{ route('admin.blog.update', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Edit Article</h5>
                                <form class="d-inline-flex">
                                    <a href="{{ route('admin.blog') }}" class="align-items-center btn btn-theme d-flex">
                                        <i class="fa fa-arrow-left"></i> Back
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
                                <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('success') }}</div>
                            @endif

                            <div class="theme-form theme-form-2 mega-form">
                                <input type="hidden" name="new" value="0">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" id="title" value="{{ $blog->title }}" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Published Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="datetime-local" name="published_at" id="published_at" value="{{ $blog->published_at }}" required>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Description</label>
                                    <div class="col-sm-10">
                                        <div class="alert alert-info small"><i class="fa fa-info-circle"></i> Please use video icon in editor below to upload youtube link.</div>
                                        <textarea class="form-control" name="description" id="description">
                                            @php echo Illuminate\Support\Facades\Storage::get('public/blog/contents/'.$blog->content); @endphp
                                        </textarea>
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
    $(document).ready(function() {
        $('textarea').richText();
        //alert(window.location.href);
    });
</script>
@endpush