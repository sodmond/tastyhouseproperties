@extends('layouts.app', ['title' => 'Subscriptions', 'activePage' => 'seller.settings'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.settings'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-privacy">
                        <div class="title">
                            <h2>Subscription History</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex mb-4">
                                <h3>History</h3>
                                <button class="btn btn-sm theme-bg-color text-white">
                                    <a class="text-white" href="{{ route('seller.settings') }}">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </button>
                            </div>

                            <div class="order-tab dashboard-bg-box">
                                <div class="table-responsive">
                                    <table class="table order-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Amount ({{$currency}})</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Gateway</th>
                                                <th scope="col">Reference</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subscriptions as $subscription)
                                            <tr>
                                                <td>{{ ucwords($subscription->package->title) }}</td>
                                                <td>{{ ucwords($subscription->type) }}</td>
                                                <td>{{ number_format($subscription->amount, 2) }}</td>
                                                <td>
                                                    <label class="success">{{ $subscription->start_date }}</label>
                                                </td>
                                                <td>
                                                    <label class="success">{{ $subscription->end_date }}</label>
                                                </td>
                                                <td>
                                                    <h6>{{ $subscription->gateway }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $subscription->reference }}</h6>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <nav class="custom-pagination">
                                        {{ $subscriptions->appends($_GET)->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection