@extends('admin.layouts.main', ['title' => 'Dashboard', 'activePage' => 'home'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- chart caard section start -->
        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                <div class="custome-1-bg b-r-4 card-body">
                    <div class="media align-items-center static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Vendors</span>
                            <h4 class="mb-0 counter">{{ number_format($sellers->count()) }}</h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="ri-user-2-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                <div class="custome-2-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Users</span>
                            <h4 class="mb-0 counter">{{ number_format($users->count()) }}</h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="ri-user-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                <div class="custome-3-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Products</span>
                            <h4 class="mb-0 counter">{{ number_format($products->count()) }}</h4>
                        </div>

                        <div class="align-self-center text-center">
                            <i class="ri-store-3-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                <div class="custome-4-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Account Subscriptions</span>
                            <h4 class="mb-0 counter">{{ number_format($subscriptions->where('type', 'general')->count()) }}</h4>
                        </div>

                        <div class="align-self-center text-center">
                            <i class="ri-bank-card-2-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                <div class="custome-3-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Prime Subscriptions</span>
                            <h4 class="mb-0 counter">{{ number_format($subscriptions->where('type', 'prime')->count()) }}</h4>
                        </div>

                        <div class="align-self-center text-center">
                            <i class="ri-bank-card-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3 col-lg-4">
            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                <div class="custome-2-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Orders</span>
                            <h4 class="mb-0 counter">{{ number_format($orders->count()) }}</h4>
                        </div>

                        <div class="align-self-center text-center">
                            <i class="ri-shopping-bag-3-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card o-hidden card-hover">
                <div class="card-header border-0 pb-1">
                    <div class="card-header-title p-0">
                        <h4>Top Categories</h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="category-slider no-arrow">
                        @foreach($categories1 as $category)
                        <div>
                            <div class="dashboard-category">
                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="category-image">
                                    <img src="{{ asset($category->icon) }}" class="img-fluid" alt="">
                                </a>
                                <a href="javascript:void(0)" class="category-name">
                                    <h6>{{ ucwords(strtolower($category->title)) }}</h6>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- chart card section End -->


        <!-- Earning chart star-->
        {{--<div class="col-xl-6">
            <div class="card o-hidden card-hover">
                <div class="card-header border-0 pb-1">
                    <div class="card-header-title">
                        <h4>Revenue Report</h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="report-chart"></div>
                </div>
            </div>
        </div>--}}
        <!-- Earning chart  end-->

        <!-- Recent orders start-->
        <div class="col-xl-12">
            <div class="card o-hidden card-hover">
                <div class="card-header card-header-top card-header--2 px-0 pt-0">
                    <div class="card-header-title">
                        <h4>Recent Orders</h4>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div>
                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @php $orderNum = ($orders->count() < 10) ? $orders->count() : 10; @endphp
                                    @for ($i=0; $i < $orderNum; $i++)
                                        @php $order = $orders[$i] @endphp
                                        <tr>
                                            <td>{{ $order->code }}</td>
                                            <td>
                                                <div class="user-name"><span>{{ $order->user->firstname.' '.$order->user->lastname }}</span></div>
                                            </td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.order', ['id' => $order->id]) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent orders end-->

        <!-- visitors chart start-->
        {{--<div class="col-xxl-4 col-md-6">
            <div class="h-100">
                <div class="card o-hidden card-hover">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-header-title">
                                <h4>Visitors</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pie-chart">
                            <div id="pie-chart-visitors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- visitors chart end-->

    </div>
</div>
@endsection