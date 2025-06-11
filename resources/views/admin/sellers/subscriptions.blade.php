@extends('admin.layouts.main', ['title' => 'All Subscriptions', 'activePage' => 'subscriptions'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Subscriptions for {{ $seller->companyname ?? ($seller->firstname.' '.$seller->lastname) }}</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.vendor', ['id' => $seller->id]) }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

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
@endsection