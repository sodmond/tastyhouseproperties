@extends('layouts.app', ['title' => 'New Product', 'activePage' => 'seller.products'])

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
                            <h2>New Product</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Add New Product</h3>
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

                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="new" value="1">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Product Title" value="{{ old('title') }}" required>
                                            <label for="title">Title</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="category1" name="category1" placeholder="Category" required>
                                                <option value="">- - - Select - - -</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ ucwords(strtolower($category->title)) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category1">Category</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="category2" name="category2" placeholder="Sub-Category" required>
                                                <option value="">- - - Select - - -</option>
                                            </select>
                                            <label for="category2">Sub-Category</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row" id="productTags2"></div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="condition" name="condition" placeholder="Condition" required>
                                                <option value="">- - - Select - - -</option>
                                                <option value="newly-built" @selected(old('condition') == 'newly-built')>Newly Built</option>
                                                <option value="renovated" @selected(old('condition') == 'renovated')>Renovated</option>
                                                <option value="not-applicable" @selected(old('condition') == 'not-applicable')>Not Applicable</option>
                                            </select>
                                            <label for="condition">Condition</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="property_size" name="property_size" placeholder="Property Size" value="{{ old('property_size') }}">
                                            <label for="property_size">Property Size</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="price_type" name="price_type" required>
                                                <option value="">- - - Select - - -</option>
                                                <option value="fixed" @selected(old('price_type') == 'fixed')>Fixed</option>
                                                <option value="negotiable" @selected(old('price_type') == 'negotiable')>Negotiable</option>
                                                <option value="call_for_price" @selected(old('price_type') == 'call_for_price')>Call For Price</option>
                                            </select>
                                            <label for="price_type">Price Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price') }}">
                                            <label for="price">Price</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="rent_type" name="rent_type" placeholder="Rent Type">
                                                <option value="">- - - Select - - -</option>
                                                <option value="annum" @selected(old('rent_type') == 'annum')>per Annum</option>
                                                <option value="quarter" @selected(old('rent_type') == 'quarter')>per Quarter</option>
                                                <option value="month" @selected(old('rent_type') == 'month')>per Month</option>
                                                <option value="week" @selected(old('rent_type') == 'week')>per Week</option>
                                                <option value="day" @selected(old('rent_type') == 'day')>per Day</option>
                                            </select>
                                            <label for="rent_type">Rent Type</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="number" class="form-control" id="legal_fee" name="legal_fee" placeholder="Legal Fee" value="{{ old('legal_fee') }}">
                                            <label for="legal_fee">Legal Fee</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="number" class="form-control" id="caution_fee" name="caution_fee" placeholder="Caution Fee" value="{{ old('caution_fee') }}">
                                            <label for="caution_fee">Caution Fee</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <input type="number" class="form-control" id="service_charge" name="service_charge" placeholder="Service Charge" value="{{ old('service_charge') }}">
                                            <label for="service_charge">Service Charge</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row" id="productTags"></div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <textarea class="form-control" name="description" id="description" style="min-height:150px;">{{ old('description') }}</textarea>
                                            <label for="description">Description</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="state" name="state" placeholder="State" required>
                                                <option value="">- - - Select - - -</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="state">State</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="city" name="city" placeholder="City">
                                                <option value="">- - - Select - - -</option>
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
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="file" class="form-control" id="image" name="image[]" required>
                                                        <label for="image">Select Image</label>
                                                    </div>
                                                </div>
                                            </div>
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
    <div class="row mt-4">
        <div class="col-8">
            <div class="form-floating theme-form-floating">
                <input type="file" class="form-control" id="image" name="image[]" required>
                <label for="image">Select Image</label>
            </div>
        </div>
        <div class="col-4">
            <a class="btn btn-sm btn-link remove_field text-danger" href="#">Remove Image</a>
        </div>
    </div>
</div>
<input type="hidden" id="getSubCategoriesLink" value="{{ url('/get-sub-categories') }}">
<input type="hidden" id="getProductTagsLink" value="{{ url('/seller/product-tags') }}">
@endsection

@push('custom-script')
    <script>
        $(document).ready(function(){
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
            let x = 1;
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

            removeRentOpt($('#category1').val());
        });
        catOneChange($('#category1').val());
        $('#category1').change(function(){
            let cat_id = $(this).val();
            catOneChange(cat_id);
            removeRentOpt(cat_id);
        });
        function catOneChange(cat_id) {
            let cat_url = $('#getSubCategoriesLink').val() + '/' + cat_id; 
            getSubCategories(cat_url, 2);
        }
        $('#category2').change(function() {
            let cat_id = $(this).val();
            getProductTags(cat_id, 2);
            if (cat_id == 346 || $('#category1').val() == 208) {
                $('#condition').parent().parent().css('display', 'none');
                $('#condition option').each(function() {
                    if ($(this).val() == 'new') {
                        $(this).prop('selected', 'selected');
                    }
                });
                //alert($('#condition').val());
            } else {
                $('#condition option').each(function() {
                    if ($(this).val() == '') {
                        $(this).prop('selected', 'selected');
                    }
                });
                $('#condition').parent().parent().css('display', 'block');
            }
        });

        function getProductTags(cat_id, level) {
            $.ajax({
                type: 'GET',
                url: $('#getProductTagsLink').val() + '/?category_id=' + cat_id,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        let productTags = '';
                        for (const [key, value] of Object.entries(data)) {
                            let newDiv = '<div class="col-md-6 mb-4"><div class="form-floating theme-form-floating"><select class="form-control" id="'+key.toLowerCase()+'" name="'+key.toLowerCase();
                            if (value.option_type == 'multiple') {
                                newDiv += '[]"';
                                newDiv += 'multiple="multiple"';
                            } else {
                                newDiv += '"';
                            }
                            newDiv += '><option value="">- - - Select - - -</option>';
                            for (const [index, item] of Object.entries(value.values)) {
                                newDiv += '<option value="'+ item +'">' + item + '</option>';
                            };
                            newDiv += '</select><label for="'+key.toLowerCase()+'">'+key+'</label></div></div>';
                            productTags += newDiv;
                        }
                        if(level == 2) {
                            $('#productTags').html(productTags);
                            $('#productTags select').select2({
                                placeholder: 'Select option'
                            });
                        } else {
                            $('#productTags2').html(productTags);
                            $('#productTags2 select').select2({
                                placeholder: 'Select option'
                            });
                        }
                    }
                }
            });
        }

        // Remove Rent Options from Non-Rent Categories
        function removeRentOpt(cat_id) {
            let rent_cats = ["1","3","5","7","8","9"];
            if (rent_cats.includes(cat_id)) {
                //alert(cat_id);
                $('#rent_type').parent().parent().show();
                $('#legal_fee').parent().parent().show();
                $('#caution_fee').parent().parent().show();
                $('#service_charge').parent().parent().show();
            } else {
                $('#rent_type').parent().parent().hide();
                $('#legal_fee').parent().parent().hide();
                $('#caution_fee').parent().parent().hide();
                $('#service_charge').parent().parent().hide();
            }
        }
    </script>
@endpush