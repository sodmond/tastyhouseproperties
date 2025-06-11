@extends('admin.layouts.main', ['title' => ucwords($user->firstname)."'s Orders", 'activePage' => 'users'])

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
                                <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.user', ['id' => $user->id]) }}">{{ ucwords($user->firstname) }}'s Details</a></li>
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ ucwords($user->firstname) }}'s Orders</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-custom">
                            <h4 class="h5 text-white">Orders List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <a class="btn btn-custom" href="{{ route('admin.user', ['id' => $user->id]) }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book #</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @php $bg_color = \App\Models\Order::getStatusBG($order->status); @endphp
                                            <tr>
                                                <td>{{ $order->code }}</td>
                                                <td>{{ count($order->orderContent) }}</td>
                                                <td>{{ number_format($order->total_cost, 2) }}</td>
                                                <td><span class="{{$bg_color}} px-2 py-1 rounded text-white">{{ $order->status }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td><a class="btn btn-sm btn-custom" href="{{ route('admin.order', ['id' => $order->id]) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-auto">{{ $orders->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <!-- container -->

    </div> <!-- content -->
@endsection