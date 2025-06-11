@extends('admin.layouts.main', ['title' => 'Vendor Details', 'activePage' => 'vendors'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Vendor Details</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.vendor.products', ['id' => $seller->id]) }}">
                                        <i class="fas fa-store"></i> Products</a>
                                </li>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.vendor.subscriptions', ['id' => $seller->id]) }}">
                                        <i class="fas fa-credit-card"></i> Subscriptions</a>
                                </li>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.vendors') }}">
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
                        <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('success') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/seller/profile_pix/'.$seller->image) }}" class="img-fluid" alt="">
                            <div class="my-3">
                                <a href="{{ route('admin.vendor.ban', ['id' => $seller->id]) }}">
                                    @if($seller->status == 0)
                                        <button class="btn btn-success"><i class="fas fa-ban"></i> &nbsp; Lift Ban</button>
                                    @else
                                        <button class="btn btn-danger"><i class="fas fa-ban"></i> &nbsp; Ban Vendor</button>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive table-product">
                                <table class="table all-packag theme-tabl" >
                                    <tbody>
                                        <tr>
                                            <th>Firstname</th>
                                            <td>
                                                <div class="user-name"><span>{{ $seller->firstname }}</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lastname</th>
                                            <td><div class="user-name">{{ $seller->lastname }}</div></td>
                                        </tr>
                                        <tr>
                                            <th>Company Name</th>
                                            <td><div class="user-name">{{ $seller->companyname }}</div></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $seller->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $seller->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $seller->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{ $seller->cityy->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{ $seller->sate->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Zip</th>
                                            <td>{{ $seller->zip }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Created</th>
                                            <td>{{ $seller->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $seller->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="fs-5 fw-bold">Bio</h5>
                        <p>{{ $seller->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection