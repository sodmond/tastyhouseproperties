@extends('layouts.app', ['title' => 'Subscriptions', 'activePage' => 'seller.settings'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-xs">
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
                            <h2>Subscription</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>
    
                        <div class="dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex mb-4">
                                <h3>Account Subscription</h3>
                                <button class="btn btn-sm theme-bg-color text-white">
                                    <a class="text-white" href="{{ route('seller.subscriptions') }}">
                                        <i class="fa fa-list"></i> History
                                    </a>
                                </button>
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

                            @php $status = 0; @endphp
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">Status:</span>
                                    @if (! isset($accountSub->end_date))
                                        <span class="bg-danger px-2 py-1 rounded text-white">Inactive</span>
                                    @elseif ($accountSub->end_date <= date('Y-m-d'))
                                        <span class="bg-danger px-2 py-1 rounded text-white">Inactive</span>
                                    @else
                                        <span class="bg-success px-2 py-1 rounded text-white">Active</span>
                                        @php $status = 1; @endphp
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">Start Date:</span> @isset($accountSub->start_date) {{ $accountSub->start_date }} @endisset
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">End Date:</span> @isset($accountSub->end_date) {{ $accountSub->end_date }} @endisset
                                </div>
                            </div>

                            @if($status == 0)
                            <fieldset {{ ($status == 1) ? 'disabled="disabled"' : '' }} style="border:0;">
                                <legend class="h6 mb-3">Subscribe Now</legend>
                                <form action="{{ route('seller.settings.subscribe') }}" method="post">
                                    @csrf
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="package" id="package" required>
                                            <option value="">- - - Select a Plan - - -</option>
                                            @foreach ($packages as $package)
                                                @if($package->type == 'general')
                                                    <option value="{{ $package->id }}">{{ ucwords($package->title) }} @ {{ $currency.$package->amount }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Subscribe</button>
                                </form>
                            </fieldset>
                            @endif
                        </div>

                        <div class="dashboard-bg-box">
                            <div class="dashboard-title mb-4">
                                <h3>Prime Subscription</h3>
                            </div>

                            @php $status = 0; @endphp
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">Status:</span>
                                    @if (! isset($primeSub->end_date))
                                        <span class="bg-danger px-2 py-1 rounded text-white">Inactive</span>
                                    @elseif ($primeSub->end_date <= date('Y-m-d'))
                                        <span class="bg-danger px-2 py-1 rounded text-white">Inactive</span>
                                    @else
                                        <span class="bg-success px-2 py-1 rounded text-white">Active</span>
                                        @php $status = 1; @endphp
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">Start Date:</span> {{ $primeSub->start_date ?? '' }}
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-6 fw-bolder">End Date:</span> {{ $primeSub->end_date ?? '' }}
                                </div>
                            </div>

                            @if($status == 0)
                            <fieldset {{ ($status == 1) ? 'disabled="disabled"' : '' }} style="border:0;">
                                <legend class="h6 mb-3">Subscribe Now</legend>
                                <form action="{{ route('seller.settings.subscribe') }}" method="post">
                                    @csrf
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="package" id="package" required>
                                            <option value="">- - - Select a Plan - - -</option>
                                            @foreach ($packages as $package)
                                                @if($package->type == 'prime')
                                                    <option value="{{ $package->id }}">{{ ucwords($package->title) }} @ {{ $currency.$package->amount }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Subscribe</button>
                                </form>
                            </fieldset>
                            @else
                            <fieldset {{ ($status == 0) ? 'disabled="disabled"' : '' }} style="border:0;">
                                <legend class="h6 mb-3">Set Prime Product</legend>
                                <form action="{{ route('seller.prime.product') }}" method="post">
                                    @csrf
                                    <div class="form-floating theme-form-floating">
                                        <?php $primeProducts = json_decode($primeSub->product_id) ?? []; ?>
                                        <select class="form-control" name="products[]" id="product" multiple required>
                                            <option value=""></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" @selected(in_array($product->id, $primeProducts))>{{ ucwords($product->title) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Update</button>
                                </form>
                            </fieldset>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#product').select2({
                placeholder: 'Select a Product',
                maximumSelectionLength: 3,
            });
        });
    </script>
@endpush