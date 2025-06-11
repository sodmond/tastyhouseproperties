@extends('admin.layouts.main', ['title' => 'Subscription Packages', 'activePage' => 'settings'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>{{ 'Subscription Packages' }}</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-theme" href="{{ route('admin.settings.home') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $row = (isset($_GET['page']) && $_GET['page'] != 1) ? 10*($_GET['page']-1)+1 : 1; ?>
                                @foreach ($packages as $package)
                                <tr>
                                    <td>
                                        {{ $row++ }}
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ ucwords($package->title) }}</span></div>
                                    </td>
                                    <td>
                                        <div class="user-name"><span>{{ ucwords($package->type) }}</span></div>
                                    </td>
                                    <td>
                                        {{ $currency.number_format($package->amount, 2) }}
                                    </td>
                                    <td>
                                        @if($package->status == 1)
                                            <small class="bg-success rounded px-2 py-1">Active</small>
                                        @else
                                            <small class="bg-danger rounded px-2 py-1">Inactive</small>
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.settings.subpack', ['id' => $package->id]) }}">
                                                    <i class="ri-pencil-line"></i>
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