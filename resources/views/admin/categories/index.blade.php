@extends('admin.layouts.main', ['title' => 'Product Categories', 'activePage' => 'category'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Category List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.category.new') }}" class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus"></i> Add New
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row row-cols-lg-auto g-3 align-items-center mb-4">
                        <div class="col-md-4">
                            @isset($_GET['search'])
                                <p>Search result for: {{ $_GET['search'] }}</p>
                            @endisset
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-6 justify-content-end">
                            <form>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Enter category title">
                                    <button class="btn btn-theme" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Level</th>
                                    <th>Parent</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="user-name"><span>{{ $category->title }}</span></div>
                                    </td>

                                    <td>
                                        @php
                                            $nf = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
                                            echo $nf->format($category->level); 
                                        @endphp
                                    </td>

                                    <td>{{ ($category->parent != '') ? $all_cats[$category->parent]->title : '' }}</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
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

                    <div class="pt-4">{{ $categories->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection