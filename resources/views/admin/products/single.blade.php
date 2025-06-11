@extends('admin.layouts.main', ['title' => 'Product Details', 'activePage' => 'products'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Product Details</h5>
                        <div class="right-options">
                            <ul>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.product.reports', ['id' => $product->id]) }}">
                                        <i class="far fa-flag"></i> Abuse Reports</a>
                                </li>
                                <li>
                                    <a class="btn btn-sm btn-custom" role="button" href="{{ route('admin.products') }}">
                                        <i class="fa fa-arrow-left"></i> Back</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (count($errors))
                                <div class="alert alert-success">
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

                    <div class="row">
                        <div class="col-md-5">
                            @php $thumbnail = json_decode($product->image)[0]; @endphp
                            <img src="{{ asset('storage/products/'.$product->seller_id.'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="">
                            <div class="my-3">
                                @if(empty($product->deleted_at))
                                <button class="btn btn-sm btn-danger col-12" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-delete-bin-line"></i> &nbsp; Delete
                                </button>
                                @else
                                <a href="{{ route('admin.product.restore', ['id' => $product->id]) }}">
                                    <button class="btn btn-sm btn-animation col-12">
                                        <i class="fa fa-sync"></i> &nbsp; Restore
                                    </button>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive table-product">
                                <table class="table all-packag theme-tabl" >
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <td>
                                                <div class="user-name"><span>{{ $product->title }}</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ ucwords(strtolower($product->category->title)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vendor</th>
                                            <td>
                                                <a href="">
                                                    <u>{{ $product->seller->firstname.' '.$product->seller->lastname }}</u>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Condition</th>
                                            <td>{{ ucwords($product->condition) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price Type</th>
                                            <td>{{ ucwords(str_replace('_', ' ', $product->price_type)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>{{ $currency.number_format($product->price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Location</th>
                                            <td>{{ \App\Models\State::find($product->city->state_id)->name .', '. ucwords($product->city->name) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Created</th>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $product->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 my-3 pt-3" style="border-top: 1px solid #eaeaea;">
                            <h3 class="mb-3">Description</h3>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="col-md-12 my-3 pt-3" style="border-top: 1px solid #eaeaea;">
                            <h3 class="mb-3">Product Images</h3>
                            <div class="row">
                                @php $productImages = json_decode($product->image); @endphp
                                @foreach ($productImages as $image)
                                    <div class="col-md-4">
                                        <img class="img-fluid" src="{{ asset('storage/products/'.$product->seller_id.'/'.$image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal Box Start -->
<div class="modal fade theme-modal remove-coupon show" id="deleteModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="GET" action="{{ route('admin.product.trash', ['id' => $product->id]) }}">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <p>This product will be deleted if you proceed with this operation. The product will still be visible to You can restore it anytime</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm fw-bold">Yes</button>
            </div>
        </form>
    </div>
</div>
@endsection