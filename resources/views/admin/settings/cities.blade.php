@extends('admin.layouts.main', ['title' => 'City List', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>{{ isset($state) ? $state->name." Cities" : 'City List' }}</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-theme" href="{{ route('admin.settings.home') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-theme" href="{{ route('admin.settings.city', ['id' => 'new']) }}"><i class="fa fa-plus-circle"></i> Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                @foreach ($cities as $city)
                                <tr>
                                    <td>
                                        {{ $row++ }}
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ $city->name }}</span></div>
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ $city->state->name }}</span></div>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.settings.city', ['id' => $city->id]) }}">
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

                    <div class="py-4">{{ $cities->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection