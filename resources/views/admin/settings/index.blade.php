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
                                            @if($admin->id != 1 && auth('admin')->user()->role != 2 && $admin->id != auth('admin')->id())
                                                <li>
                                                    <a href="{{ route('admin.settings.admin.get', ['id' => $admin->id]) }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <input type="hidden" id="{{'adminName'.$admin->id}}" value="{{$admin->firstname.' '.$admin->lastname}}">
                                                    <input type="hidden" id="{{'deleteAdminUrl'.$admin->id}}" value="{{ route('admin.settings.admin.trash', ['id' => $admin->id]) }}">
                                                    <a href="javascript:void(0)" id="{{'deleteAdminBtn-'.$admin->id}}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            @endif
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

@push('custom-scripts')
<script>
    $('a[id^="deleteAdminBtn"]').click(function() {
        var getBtnId = $(this).attr('id');
        var adminId = getBtnId.split("-")[1];
        var name = $("#adminName"+adminId).val();
        var x = confirm('Do you want to delete this Admin ('+name+')? This process cannot be reversed');
        if (x == true) {
            var url = $('#deleteAdminUrl'+adminId).val();
            window.location.href = url;
        }
    });
</script>
@endpush