@extends('layouts.app', ['title' => 'New Review', 'activePage' => 'user.reviews'])

@section('content')
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-xs">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                @include('user.layouts.sidebar', ['activePage' => 'user.reviews'])
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                    Dashboard Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>New Review</h2>
                            <span class="title-leaf">
                                &nbsp;
                            </span>
                        </div>

                        <div class="profile-tab dashboard-bg-box">
                            <div class="dashboard-title dashboard-flex">
                                <h3>Add New Review</h3>
                                <button class="btn btn-sm theme-bg-color"><a class="text-white" href="{{ route('user.reviews') }}"><i class="fa fa-arrow-left"></i>  Back</a></button>
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
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" id="seller_id" name="seller_id" required>
                                                <option value="">- - - Select - - -</option>
                                                @foreach($sellers as $seller)
                                                    <option value="{{ $seller->id }}">{{ $seller->companyname ?? $seller->firstname.' '.$seller->lastname }}</option>
                                                @endforeach
                                            </select>
                                            <label for="seller_id">Vendor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <input type="number" name="rating" id="rating" class="rating" data-clearable="" data-icon-lib="fa" data-active-icon="fa-star" data-inactive-icon="fa-star-o" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating theme-form-floating">
                                            <textarea class="form-control" name="comment" id="comment" style="min-height:150px;" required>{{ old('comment') }}</textarea>
                                            <label for="description">Comment</label>
                                        </div>
                                    </div>
                                    <div class="col mb-4 pt-3" style="border-top:1px solid #dcdcdc;">
                                        <span class="fs-5" style="float:left;">Product Image (Optional)</span>
                                        <button type="button" class="btn btn-sm theme-bg-color text-white" style="float:right;" id="add_more_image_btn">
                                            Add More Image</button>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div id="product_image_section">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="file" class="form-control" id="image" name="image[]">
                                                        <label for="image">Select Image</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-primary">Allowed images; .jpg, .png, .jpeg | Max: 512kb | Min-Width: 370px (Square Dimension)</small>
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
@endsection

@push('custom-script')
    <script src="{{ asset('frontend/js/tastyhouse.js') }}"></script>
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @isset($_GET['vendor'])
    <script>
        $(document).ready(function() {
            let vendorId = {{ $_GET['vendor'] }}
            $('#seller_id option[value='+vendorId+']').attr('selected', 'selected');
        });
    </script>
    @endisset
@endpush