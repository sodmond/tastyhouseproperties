@extends('layouts.app', ['title' => 'My Products', 'activePage' => 'seller.products'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.products'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="product-tab">
                        <div class="title">
                            <h2>My Products</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="table-responsive dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Product List</h3>
                                <button class="btn btn-sm theme-bg-color text-white">
                                    <a class="text-white" href="{{ route('seller.product.new') }}">
                                        <i class="fa fa-plus-circle"></i> Add New
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

                            <table class="table product-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Images</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Prime Status</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="product-image">
                                            @php $thumbnail = json_decode($product->image)[0]; @endphp
                                            <img src="{{ asset('storage/products/'.auth('seller')->id().'/thumbnail/'.$thumbnail) }}" class="img-fluid" alt="">
                                        </td>
                                        <td>
                                            <h6 id="{{ 'productName_'.$product->id }}">{{ $product->title }}</h6>
                                        </td>
                                        <td>
                                            <form action="{{ route('seller.product.prime') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input prime-status" type="checkbox" name="status" role="switch" {{ ($product->prime_status == true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                                        {{ ($product->prime_status == true) ? 'Active' : 'Inactive' }}</label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <h6 class="theme-color fw-bold">
                                                {{ ($product->price_type == 'call_for_price') ? 'Call for Price' : $currency.number_format($product->price, 2) }}</h6>
                                        </td>
                                        <td class="edit-delete">
                                            <a href="{{ route('seller.product.edit', ['id' => $product->id]) }}"><i data-feather="edit" class="edit"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteProduct({{$product->id}})"><i data-feather="trash-2" class="delete"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav class="custom-pagination">
                                {{ $products->appends($_GET)->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Delete Confirmation Modal -->
<div class="modal fade theme-modal remove-coupon show" id="productDeleteModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('seller.product.delete') }}">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Confirm Product Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <div class="col-12 mb-4">
                        @csrf
                        <input type="text" class="form-control" id="productNameDelete" readonly>
                        <input type="hidden" name="product_id" id="productIdDelete">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-sm fw-bold">Proceed</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('custom-script')
    <script>
        function deleteProduct(id) {
            let productName = $('#productName_' + id).text();
            $('#productNameDelete').val(productName);
            $('#productIdDelete').val(id);
            $('#productDeleteModal').modal('show');
        }
        $('.prime-status').change(function(){
            let formDiv = $(this).parent().parent();
            formDiv.submit();
        });
    </script>
@endpush