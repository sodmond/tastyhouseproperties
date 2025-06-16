@extends('layouts.app', ['title' => 'Edit Product', 'activePage' => 'seller.products'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('seller.layouts.sidebar', ['activePage' => 'seller.products'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>Edit Product</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Edit Product Details</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('seller.products') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
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

                            <form action="{{ route('seller.product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="new" value="0">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Product Title" value="{{ $product->title }}" required>
                                            <label for="title">Title</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="category1" name="category1" placeholder="Category" required disabled>
                                                <option value="">- - - Select - - -</option>
                                                @foreach($categories[0] as $category)
                                                    <option value="{{ $category->id }}" @selected($cat_choice[0] == $category->id)>{{ ucwords(strtolower($category->title)) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category1">Category</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="category2" name="category2" placeholder="Sub-Category" required>
                                                <option value="">- - - Select - - -</option>
                                                @foreach($categories[1] as $category)
                                                    <option value="{{ $category->id }}" @selected($cat_choice[1] == $category->id)>{{ ucwords(strtolower($category->title)) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category2">Sub-Category</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="condition" name="condition" placeholder="Condition" required>
                                                <option value="">- - - Select - - -</option>
                                                <option value="newly-built" @selected($product->condition == 'newly-built')>Newly Built</option>
                                                <option value="renovated" @selected($product->condition == 'renovated')>Renovated</option>
                                                <option value="not-applicable" @selected($product->condition == 'renovated')>Not Applicable</option>
                                            </select>
                                            <label for="condition">Condition</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="price_type" name="price_type" required>
                                                <option value="">- - - Select - - -</option>
                                                <option value="fixed" @selected($product->price_type == 'fixed')>Fixed</option>
                                                <option value="negotiable" @selected($product->price_type == 'negotiable')>Negotiable</option>
                                                <option value="call_for_price" @selected($product->price_type == 'call_for_price')>Call For Price</option>
                                            </select>
                                            <label for="price_type">Price Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{ $product->price }}">
                                            <label for="price">Price</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row" id="productTags">
                                            @foreach ($product_tags as $tag)
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating theme-form-floating">
                                                        <select class="form-control" id="{{ strtolower($tag->attribute->title) }}" name="{{ strtolower($tag->attribute->title) }}[]" {{ ($tag->attribute->option_type == 'multiple') ? 'multiple' : '' }}>
                                                            <option value="">- - - Select - - -</option>
                                                            @foreach (json_decode($tag->attribute->values) as $item)
                                                                <option value="{{$item}}" @selected(in_array($item, json_decode($tag->value)))>{{$item}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="{{ strtolower($tag->attribute->title) }}">{{ $tag->attribute->title }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <textarea class="form-control" name="description" id="description" style="min-height:150px;">{{ $product->description }}</textarea>
                                            <label for="description">Description</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="state" name="state" placeholder="State" required>
                                                <option value="">- - - Select - - -</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" @selected($product->city->state->id == $state->id)>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="state">State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="city" name="city" placeholder="City">cities
                                                <option value="">- - - Select - - -</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" @selected($product->city_id == $city->id)>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <div class="col mb-4 pt-3" style="border-top:1px solid #dcdcdc;">
                                        <span class="fs-5" style="float:left;">Product Image</span>
                                        <button type="button" class="btn btn-sm theme-bg-color text-white" style="float:right;" id="add_more_image_btn">
                                            Add More Image</button>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div id="product_image_section">
                                            @foreach(json_decode($product->image) as $key => $image)
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <img src="{{ asset('storage/products/'.auth('seller')->id().'/'.$image) }}" class="img-fluid" style="max-height: 100px;" alt="">
                                                </div>
                                                <div class="col-9">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="file" class="form-control imageUpload" id="image" name="image[]">
                                                        <label for="image">Select Image</label>
                                                    </div>
                                                    @if ($key != 0)
                                                        <a class="btn btn-sm btn-link remove_field text-danger" href="#">Remove Image</a>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <small class="text-primary">Allowed images; .jpg, .png, .jpeg | Max: 1MB | Min-Width: 370px (Square Dimension)</small>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm theme-bg-color text-white">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="getStateCitiesLink" value="{{ url('/get-state-city') }}">
<div id="image_add" style="display: none;">
    <div class="row mb-3">
        <div class="col-3">
            <img class="img-fluid" src="{{ asset('img/placeholder.jpg') }}" alt="">
        </div>
        <div class="col-9">
            <div class="form-floating theme-form-floating">
                <input type="file" class="form-control imageUpload" name="image[]">
                <label for="image">Select Image</label>
            </div>
            <a class="btn btn-sm btn-link remove_field text-danger" href="#">Remove Image</a>
        </div>
    </div>
</div>
<input type="hidden" id="getSubCategoriesLink" value="{{ url('/get-sub-categories') }}">
@endsection

@push('custom-script')
    <script>
        $(document).ready(function(){
            $('div').on('change', '.imageUpload', function(){ //alert();
                let imageContainer = $(this).parent('div');
                let imageCol = $(imageContainer).parent('div');
                let imageRow = $(imageCol).parent('div');
                $(imageRow).children(':first-child').html("<img src='"+URL.createObjectURL(event.target.files[0])+"' class='img-fluid'>");
            });
            $('#productTags select[multiple]').select2({
                placeholder: 'Select option'
            });
            $('#state').change(function() {
                let state_id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: $('#getStateCitiesLink').val() + '/' + state_id,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            let cities = '<option value="">- - - Select City - - -</option>';
                            data.cities.forEach(element => {
                                cities += '<option value="' + element.id + '">' + element.name + '</option>';
                            });
                            $('#city').html(cities);
                        }
                    }
                });
            });
            
            let max_fields = 5; 
            let wrapper = $('#product_image_section');
            let add_btn = $('#add_more_image_btn');
            let x = $('#product_image_section').children().length;
            $(add_btn).click(function(e){ //alert();
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append($('#image_add').html());
                }
            });
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault(); 
                let parentDiv = $(this).parent('div')
                $(parentDiv).parent('div').remove(); x--;
                //console.log(x);
            });
        });
        $('#category1').change(function(){
            let cat_id = $(this).val();
            let cat_url = $('#getSubCategoriesLink').val() + '/' + cat_id; 
            getSubCategories(cat_url, 2);
            $('#category3').html('<option value="">- - - Select - - -</option>')
        });
        $('#category2').change(function(){
            let cat_id = $(this).val();
            let cat_url = $('#getSubCategoriesLink').val() + '/' + cat_id; 
            getSubCategories(cat_url, 3);
        });
    </script>
@endpush