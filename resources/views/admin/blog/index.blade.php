@extends('admin.layouts.main', ['title' => 'Blog/Podcasts', 'activePage' => 'blog'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Articles List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.blog.new') }}" class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus"></i> Add New
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Published Date</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($blog as $article)
                                <tr>
                                    <td>
                                        <div>
                                            <img src="{{ asset('storage/blog/image/'.$article->image) }}" class="img-fluid" alt="" style="max-height: 45px;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ $article->title }}</span></div>
                                    </td>
                                    <td>{{ $article->published_at }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.blog.edit', ['id' => $article->id]) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-4">{{ $blog->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection