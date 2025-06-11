@extends('admin.layouts.main', ['title' => 'Order Details', 'activePage' => 'orders'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Order Details</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.orders') }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            @php $thumbnail = json_decode($product->image)[0]; @endphp
                            <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="">
                            {{--<div class="my-3">
                                <a href="{{ route('admin.order', ['id' => $order->id]) }}">
                                    <button class="btn btn-sm btn-info"><i class="ri-edit-line"></i></button>
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                                    <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                </a>
                            </div>--}}
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive table-product">
                                <table class="table all-packag theme-tabl" >
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>
                                                <div class="user-name"><span>{{ $order->code }}</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>User</th>
                                            <td>
                                                <a href="{{ route('admin.user', ['id' => $order->user_id]) }}" target="_blank">
                                                    <u>{{ $order->user->firstname.' '.$order->user->lastname }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Vendor</th>
                                            <td>
                                                <a href="{{ route('admin.vendor', ['id' => $seller->id]) }}" target="_blank">
                                                    <u>{{ $seller->companyname ?? $seller->firstname.' '.$seller->lastname }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Product Name</th>
                                            <td>{{ $product->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ $currency.number_format($order->amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Created</th>
                                            <td>{{ $order->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $order->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Products</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.orders') }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive table-product">
                            <table class="table all-package theme-table" >
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Vendor</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div>
                                                @php $thumbnail = json_decode($product->image)[0]; @endphp
                                                <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="" style="max-height: 45px;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user-name"><span>{{ $product->title }}</span></div>
                                        </td>
                                        <td>{{ ucwords(strtolower($product->category->title)) }}</td>
                                        <td>{{ $product->seller->firstname.' '.$product->seller->lastname }}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.product', ['id' => $product->id]) }}">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalToggle">
                                                        <i class="ri-delete-bin-line"></i>
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
        </div>--}}
    </div>
</div>
@endsection