@extends('admin.layouts.main', ['title' => 'All Orders', 'activePage' => 'orders'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Order List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row row-cols-lg-auto g-3 align-items-center mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.orders.export') }}" method="GET">
                                <div class="input-group">
                                    <select class="form-control" name="month">
                                        <option value="">- - - Month - - -</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select class="form-control" name="year">
                                        <option value="">- - - Year - - -</option>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{ 2025 + $i }}">{{ 2025 + $i }}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-theme" type="submit">Export</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 justify-content-end">
                            <form>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Enter Order ID">
                                    <button class="btn btn-theme" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset($_GET['search'])
                        <p>Search result for: {{ $_GET['search'] }}</p>
                    @endisset

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->code }}</td>
                                    <td>
                                        <div class="user-name"><span>{{ $order->user->firstname.' '.$order->user->lastname }}</span></div>
                                    </td>
                                    <td>{{ $currency.number_format($order->amount, 2) }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-4">{{ $orders->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection