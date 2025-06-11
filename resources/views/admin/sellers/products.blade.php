@extends('admin.layouts.main', ['title' => 'All Products', 'activePage' => 'products'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>Products for {{ $seller->companyname ?? ($seller->firstname.' '.$seller->lastname) }}</h5>
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
                                            {{--<li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>--}}
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-4">{{ $products->appends($_GET)->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection