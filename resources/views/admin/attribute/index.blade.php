@extends('admin.layouts.main', ['title' => 'Attributes', 'activePage' => 'attributes'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Attribute List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.attributes.new') }}" class="align-items-center btn btn-theme d-flex">
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
                                    <th>Title</th>
                                    <th>Values</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($attributes as $attribute)
                                <tr>
                                    <td>
                                        <div class="user-name"><span>{{ $attribute->title }}</span></div>
                                    </td>

                                    {{-- (\App\Models\ProductCategory::whereIn('id', json_decode($attribute->categories))->pluck('title')) --}}

                                    <td><div style="max-width:40vw; white-space:normal;">{{ implode(',', json_decode($attribute->values)) }}</div></td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.attribute.edit', ['id' => $attribute->id]) }}">
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

                    <div class="pt-4">{{ $attributes->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection