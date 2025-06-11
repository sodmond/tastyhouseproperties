@extends('admin.layouts.main', ['title' => 'Settings', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Settings</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-dark" href="{{ route('admin.newsletter') }}">Newsletter Subscription</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-primary" href="{{ route('admin.settings.adverts') }}">Advert Placement</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-warning" href="{{ route('admin.settings.states') }}">States</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-info" href="{{ route('admin.settings.cities') }}">Cities</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-success" href="{{ route('admin.settings.subpacks') }}">Subscription Packages</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a class="btn btn-secondary" href="{{ route('admin.settings.plugview') }}">Plugview Newsroom</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Administrators List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-theme" href="{{ route('admin.settings.admin.get', ['id' => 'new']) }}">Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <div class="user-name"><span>{{ $admin->firstname }}</span></div>
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ $admin->lastname }}</span></div>
                                    </td>
                                    <td>{{ ucwords($admin->adminRole->title) }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.settings.admin.get', ['id' => $admin->id]) }}">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection