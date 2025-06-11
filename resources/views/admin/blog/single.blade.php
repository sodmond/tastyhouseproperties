@extends('admin.layouts.main', ['title' => ucwords($blogItem->title), 'activePage' => 'blogItems'])

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.blog') }}">Blog/Podcast</a></li>
                                <li class="breadcrumb-item active">Single Blog</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Single Blog</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-custom">
                            <h4 class="h5 text-white">Blog Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <a class="btn btn-custom" href="{{ route('admin.blog') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="col-6 text-right">
                                    {{--<a class="btn btn-info" href="{{ route('admin.blog.edit', ['id' => $blogItem->id]) }}"><i class="fa fa-edit"></i> Edit</a>--}}
                                    <button class="btn btn-danger" id="deleteBtn"><i class="fa fa-trash"></i> Delete</button>
                                    <input type="hidden" id="deleteUrl" value="{{ route('admin.blog.trash', ['id' => $blogItem->id]) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-fluid" src="{{ asset('storage/author/blog/image/thumbnail/'.$blogItem->thumbnail) }}" alt="Cover Image">
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Type</th>
                                                <td>{{ ucwords($blogItem->type) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ $blogItem->title }}</td>
                                            </tr>
                                            @if(!empty($blogItem->video))
                                            <tr>
                                                <th>Video</th>
                                                <td>
                                                    <a class="btn btn-custom" href="#videoSection"> 
                                                        <i class="fas fa-video"></i> Watch
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Published Date</th>
                                                <td>{{ $blogItem->published_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date Created</th>
                                                <td>{{ $blogItem->created_at }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <strong>Description</strong>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <td><?php echo Illuminate\Support\Facades\Storage::get('author/blog/contents/'.$blogItem->content); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <strong>Banner Image</strong>
                                    <img class="img-fluid" src="{{ asset('storage/author/blog/image/'.$blogItem->image) }}" alt="Banner Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($blogItem->video))
            <div class="row" id="videoSection">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-custom">
                            <h4 class="h5 text-white">Video Attachment</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="video-wrapper" style="">
                                        <video width="100%" controls preload="auto" style="width:100% height:100%;">
                                            <source src="{{ asset('storage/'.$blogItem->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@push('custom-scripts')
    <script>
        $('#deleteBtn').click(function(e) {
            e.preventDefault();
            var deleteUrl = $('#deleteUrl').val();
            var x = confirm('Do you want to delete this blog/podcast? This action cannot be reversed.')
            if (x == true) {
                window.location.href = deleteUrl;
            }
        });
    </script>
@endpush