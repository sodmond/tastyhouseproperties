@extends('admin.layouts.main', ['title' => 'All Subscriptions', 'activePage' => 'subscriptions'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Subscription List</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <button class="align-items-center btn btn-theme d-flex" data-bs-toggle="modal" data-bs-target="#verifyPayment">
                                        Verify Payment
                                    </button>
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

                    {{--<div class="row row-cols-lg-auto g-3 align-items-center mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('admin.subscriptions.export') }}" method="GET">
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
                                    <input type="text" class="form-control" name="search" placeholder="Enter subscription ID">
                                    <button class="btn btn-theme" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset($_GET['search'])
                        <p>Search result for: {{ $_GET['search'] }}</p>
                    @endisset--}}

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" >
                            <thead>
                                <tr>
                                    <th>Vendor</th>
                                    <th>Package</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Date Created</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                <tr>
                                    <td>
                                        <div class="user-name"><span>
                                            {{ $subscription->seller->companyname ?? ($subscription->seller->firstname.' '.$subscription->seller->lastname) }}
                                        </span></div>
                                    </td>
                                    <td>
                                        {{ $subscription->package->title }}
                                    </td>
                                    <td>{{ ucwords($subscription->type) }}</td>
                                    <td>{{ $currency.number_format($subscription->amount, 2) }}</td>
                                    <td>{{ $subscription->created_at }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.subscription', ['id' => $subscription->id]) }}">
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

                    <div class="pt-4">{{ $subscriptions->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Verification Modal Box Start -->
<div class="modal fade theme-modal remove-coupon show" id="verifyPayment" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('admin.subscriptions.activate') }}">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Payment Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <p>Verify a subscription payment and activate the subscription.</p>
                    <div class="theme-form theme-form-2 mega-form">
                        @csrf
                        <div class="my-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0 required" for="reference">Reference</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="reference" id="reference" placeholder="Enter reference number here..." required="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-sm fw-bold">Verify</button>
            </div>
        </form>
    </div>
</div>
@endsection