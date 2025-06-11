@extends('layouts.backend', ['title' => 'Settings', 'activePage' => 'settings'])

@section('content')
<div class="row py-4" id="editProfile">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-custom shadow-custom border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add New Administrator</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="row">
                        <fieldset class="col" {{ (Auth::guard('admin')->user()->role != 1) ? 'disabled' : '' }}>
                            @if (count($errors))
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There are some problems with your input.<br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success"><strong>Success!</strong> {{ session('success') }}</div>
                            @endif
                            <form class="row" action="{{ route('admin.profile.new') }}" method="post">
                                @csrf
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value=""> - - - Choose Admin Role - - - </option>
                                            @foreach ($adminRoles as $role)
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-remit">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <div class="input-remit">
                                        <button type="submit" class="btn bg-gradient-custom2 w-100">Save</button>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row py-4" id="adminList">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-custom shadow-custom border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">List of Registered Administrators</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="row" style="max-height:300px; overflow-y:scroll;">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">#</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Firstname</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lastname</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date Created</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Updated</th>
                                      <th class="text-center text-secondary opacity-7">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td class="text-sm font-weight-bold mb-0">{{ $row++ }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ $admin->firstname }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ $admin->lastname }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ $admin->email }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ \App\Models\Admin::getRoleName($admin->role) }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ $admin->created_at }}</td>
                                            <td class="text-sm font-weight-bold mb-0">{{ $admin->updated_at }}</td>
                                            <td class="text-sm font-weight-bold mb-0">
                                                @if ($admin->id != 1 && Auth::guard('admin')->user()->role != 2)
                                                    {{--<a class="btn btn-sm bg-gradient-danger" href="{{ ($admin->id != Auth::guard('admin')->id()) ? route('admin.profile.delete', ['id' => $admin->id]) : 'javascript:void(0)' }}">
                                                        <i class="fa fa-trash"></i></a>--}}
                                                    <input type="hidden" id="{{'adminName'.$admin->id}}" value="{{$admin->firstname.' '.$admin->lastname}}">
                                                    <input type="hidden" id="{{'deleteAdminUrl'.$admin->id}}" value="{{ route('admin.profile.delete', ['id' => $admin->id]) }}">
                                                    <button class="btn btn-sm bg-gradient-danger" id="{{'deleteAdminBtn-'.$admin->id}}" {{($admin->id == Auth::guard('admin')->id()) ? 'disabled' : ''}}>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
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
</div>
@endsection

@push('custom-scripts')
    <script>
        $('button[id^="deleteAdminBtn"]').click(function() {
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