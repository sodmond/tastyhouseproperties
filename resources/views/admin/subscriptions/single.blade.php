@extends('admin.layouts.main', ['title' => 'Subscription Details', 'activePage' => 'Subscriptions'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Subscription Details</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.subscriptions') }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="table-responsive table-product">
                                <table class="table all-packag theme-tabl" >
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>
                                                {{ $subscription->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Vendor</th>
                                            <td>
                                                <a href="{{ route('admin.vendor', ['id' => $subscription->seller_id]) }}" target="_blank">
                                                    <u>{{ $seller->companyname ?? $seller->firstname.' '.$seller->lastname }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Package</th>
                                            <td>{{ ucwords($subscription->package->title) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td>{{ ucwords($subscription->type) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ $currency.number_format($subscription->amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $subscription->start_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $subscription->end_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gateway</th>
                                            <td>{{ ucwords($subscription->gateway) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Reference</th>
                                            <td>{{ $subscription->reference }}</td>
                                        </tr>
                                        <tr>
                                            <th>Memo</th>
                                            <td>{{ $subscription->memo }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Created</th>
                                            <td>{{ $subscription->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $subscription->updated_at }}</td>
                                        </tr>
                                        @if ($subscription->type == 'prime')
                                            <tr>
                                                <th>Prime Product</th>
                                                <td>
                                                    @if (!empty($subscription->product_id))
                                                        <a href="{{ route('admin.product', ['id' => $subscription->product_id]) }}" target="_blank">
                                                            View Product</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection