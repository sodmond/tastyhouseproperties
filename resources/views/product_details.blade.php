@php $productName = $product->title; @endphp
@extends('layouts.app', ['title' => $productName, 'activePage' => 'product'])

@section('content')
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div>
                @if (count($errors))
                    <div class="alert alert-danger">
                        <strong class="text-danger">Whoops!</strong> Error validating data.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
            </div>
            <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-6">
                        <div class="product-left-box">
                            <div class="row g-sm-4 g-2">
                                <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                    <div class="product-main-2 no-arrow">
                                        @php $productImages = json_decode($product->image); $i=1; @endphp
                                        @foreach($productImages as $image)
                                            <div>
                                                <div class="slider-image">
                                                    <img src="{{ asset('storage/products/'.$product->seller_id.'/'.$image) }}" onclick="openModal();currentSlide({{$i}})" 
                                                        data-zoom-image="{{ asset('storage/products/'.$product->seller_id.'/'.$image) }}" 
                                                        class="img-fluid image_zoom_cls-{{$i}} blur-up lazyload" alt="" style="width:100%; cursor:pointer;">
                                                </div>
                                            </div>
                                            <?php $i++ ?>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                    <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                        @php $productImages = json_decode($product->image) @endphp
                                        @foreach($productImages as $image)
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ asset('storage/products/'.$product->seller_id.'/'.$image) }}"
                                                        class="img-fluid blur-up lazyload" alt="" style="width:100%;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 wow fadeInUp">                        
                        <div class="right-box-contain">
                            @php 
                                $catSlug = \App\Models\ProductCategory::getSlug($product->category->title);
                                $catUrl = route('shop.category', ['id' => $product->category->id, 'slug' => $catSlug]);
                            @endphp
                            <h6 class="offer-top" onclick="window.location.href='{{ $catUrl }}'" style="cursor:pointer;">
                                {{ ucwords(strtolower($product->category->title)) }}</h6>
                            @if($product->prime_status == 1)
                                <h6 class="offer-top" style="background-color:#F39C12; color:#000;">{{ 'Prime' }}</h6>
                            @endif
                            <h2 class="name">{{ $product->title }}</h2>
                            <div class="price-rating">
                                <h3 class="theme-color price">
                                    @if(!in_array($product->price_type, ['fixed', 'negotiable']))
                                        <span class="theme-color">{{ ucwords(str_replace('_', ' ', $product->price_type)) }}</span>
                                    @elseif($product->price_type == 'negotiable')
                                        <span class="theme-color">{{ $currency.number_format($product->price, 2) }} <small class="text-dark">Negotiable</small></span>
                                    @else
                                        <span class="theme-color">{{ $currency.number_format($product->price, 2) }}</span>
                                    @endif
                                </h3>
                            </div>

                            <div class="product-contain">
                                <p><i class="fa fa-map-marker-alt"></i> &nbsp; {{ $product->city->name .', '.$product->city->state->name }}</p>
                                @if($product->product_category_id != 346 && $category->parent != 346)
                                    <p><strong>Condition:</strong> {{ ucwords($product->condition) }}</p>
                                @endif
                                @if(count($product->tags) > 0)
                                    @foreach ($product->tags as $tag)
                                        <p>@php echo '<strong>' . $tag->attribute->title .':</strong> '. implode(',', json_decode($tag->value)) @endphp</p>
                                    @endforeach
                                @endif
                            </div>

                            
                            <div class="buy-box">
                                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('wishlistForm').submit()">
                                    @php echo ($favorite == false) ? '<i class="far fa-heart"></i>' : '<i class="fas fa-heart theme-color"></i>' @endphp
                                    <span>{{ ($favorite == true) ? 'Remove' : 'Add To Wishlist' }}</span>
                                </a>
                                <form action="{{ route('user.wishlist.add') }}" method="post" id="wishlistForm">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </form>
                                <a class="text-danger" href="javascript:void(0)" id="reportBtn">
                                    <i class="far fa-flag"></i>
                                    <span>Report Abuse</span>
                                </a>
                            </div>

                            <div class="vendor-detail-box mt-4" style="border-radius: 0 !important;">
                                <div class="vendor-share">
                                    <h5>Share :</h5>
                                    <ul>
                                        <li>
                                            <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u='.url()->full() }}" target="_blank">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ 'https://x.com/intent/post?text='.$product->title.'&url='.url()->full() }}" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ 'https://www.linkedin.com/shareArticle/?mini=true&url='.url()->full().'&title='.$product->title }}" target="_blank">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ 'https://wa.me/?text='.url()->full() }}" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 wow fadeInUp mb-4">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab">Description</button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab mb-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 wow fadeInUp">
                <div class="right-sidebar-box">
                    <!-- Vendor -->
                    <div class="vendor-box">
                        <div class="vendor-contain">
                            <div class="vendor-image">
                                <img src="{{ asset('storage/seller/profile_pix/'.$product->seller->image) }}" alt="" class="blur-up lazyload" 
                                    onclick="window.location.href='{{ route('seller.details', ['id' => $product->seller_id]) }}'" style="cursor: pointer">
                            </div>

                            <div class="vendor-name">
                                <h5 class="fw-500 mb-2" onclick="window.location.href='{{ route('seller.details', ['id' => $product->seller_id]) }}'" style="cursor: pointer">
                                    {{ $product->seller->companyname ?? $product->seller->firstname.$product->seller->lastname }}</h5>

                                @if ($product->seller->kyc_status == 1)
                                    <span class="text-success border-success px-2 py-1 rounded small">
                                        <i class="fa fa-check-circle"></i> Verified ID</span>
                                @else
                                    <span class="text-danger border-danger px-2 py-1 rounded small">
                                        <i class="fa fa-times-circle"></i> Not Verified</span>
                                @endif

                            </div>
                            <div class="product-rating mt-1">
                                <ul class="rating">
                                    @php $rating = (count($product->seller->reviews) > 0) ? round($product->seller->reviews->sum('rating') / count($product->seller->reviews)) : 0; @endphp
                                    @for($i=1; $i <= 5; $i++)
                                        <li>
                                            <i data-feather="star" class="{{ ($i <= $rating) ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span>({{ count($product->seller->reviews) }} Reviews)</span>
                            </div>
                        </div>

                        <p class="vendor-detail">{{ $product->seller->bio }}</p>

                        <div class="vendor-list">
                            <ul>
                                <li>
                                    <div class="address-contact">
                                        <i data-feather="map-pin"></i>
                                        <h5>Location: <span class="text-content">
                                            @if(isset($product->seller->cityy->name) && isset($product->seller->sate->name))
                                                {{ $product->seller->cityy->name.', '.$product->seller->sate->name }}
                                            @endif
                                        </span></h5>
                                    </div>
                                </li>

                                <?php $subscription = \App\Models\Subscription::where('seller_id', $product->seller_id)->where('type', 'general')->latest()->first(); ?>
                                @if($subscription->end_date > date('Y-m-d'))
                                <li>
                                    <div class="address-contact">
                                        <i data-feather="headphones"></i>
                                        <h5>Contact Seller: <span class="text-content" style="cursor: pointer;" onclick="window.location.href='tel:+234{{ $product->seller->phone }}'">
                                            +234{{ $product->seller->phone }}</span></h5>
                                    </div>
                                </li>
                                @endif
                                <li style="width: 100%;">
                                    <div class="">
                                        <form action="{{ route('user.messages.initiate') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                            <div class="row justify-content-center">
                                                <button class="btn btn-animation col-12" type="submit"><i class="fa fa-comments"></i> &nbsp; Start Chat</button>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Trending Product -->
                    <div class="pt-25">
                        <div class="category-menu">
                            <h3>Buyer and Seller Safety Disclaimer for Tastyhouse Stores</h3>

                            <ul style="border-bottom:0px;">
                                <li>As a buyer, we recommend you carefully review product details before making any purchase to ensure you're getting exactly what you expect.</li>
                                <li>Tastyhouse Stores cannot guarantee the quality, authenticity, or condition of products sold by third-party sellers. To protect yourself, we encourage you to check reviews, ratings, and the seller’s reputation before completing your purchase.</li>
                                <li>Tastyhouse Stores does not handle product delivery, so we urge you to ensure that sellers provide clear delivery details and expected delivery timelines.</li>
                                <li>Return and refund policies are set by the seller. Before making a purchase, carefully review the seller's return policy to understand your rights in case you need to return an item.</li>
                                <li>As Tastyhouse Stores is a marketplace platform, we do not directly control the products sold by third-party sellers. We advise you to research the seller and product thoroughly before committing to a purchase. Your safety and satisfaction are our priority, and we encourage you to report suspicious listings.</li>
                                <li>Tastyhouse Stores is not liable for any damages, losses, or issues arising from your purchase or use of products sold by third-party sellers. It is essential for buyers to exercise caution, conduct proper research, and communicate with sellers directly if any concerns arise.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Banner Section -->
                    @php 
                    $ad_sidebar = $adverts->where('slug', "product-page-sidebar")->first();
                    $adImage = asset('storage/advert/'.$ad_sidebar->image) ?? asset('img/adverts/ad_sidebar.gif');
                    $buttonText = $ad_sidebar->button_text ?? 'Click here';
                    $adUrl = $ad_sidebar->url ?? '#';
                    if ($ad_sidebar->end_date < date('Y-m-d')) {
                        $adImage = asset('img/adverts/ad_sidebar.gif');
                        $buttonText = 'Contact';
                        $adUrl = route('advertise');
                    }
                    @endphp
                    <div class="ratio_156 pt-25">
                        <div class="home-contain" onclick="window.location.href='{{ $adUrl }}'" style="cursor: pointer;">
                            <img src="{{ $adImage }}" class="bg-img blur-up lazyload" alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-list-section section-b-space">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Related Products</h2>
            <span class="title-leaf">
                &nbsp;
            </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-6_1 product-wrapper">
                    @foreach($related as $r_product)
                    <div>
                        <div class="product-box-3 wow fadeInUp">
                            <div class="product-header">
                                <div class="product-image">
                                    @php $thumbnail = json_decode($r_product->image)[0]; @endphp
                                    <a href="{{ route('product', ['slug' => $r_product->slug]) }}">
                                        <img src="{{ asset('storage/products/'.$r_product->seller_id.'/thumbnail/'.$thumbnail) }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="product-footer">
                                <div class="product-detail">
                                    <span class="span-name">{{ ucwords(strtolower($r_product->category->title)) }}</span>
                                    <a href="{{ route('product', ['slug' => $r_product->slug]) }}">
                                        <h5 class="name">{{ $r_product->title }}</h5>
                                    </a>
                                    <h5 class="price">
                                        @if(!in_array($r_product->price_type, ['fixed', 'negotiable']))
                                            <span class="theme-color">{{ ucwords(str_replace('_', ' ', $r_product->price_type)) }}</span>
                                        @elseif($r_product->price_type == 'negotiable')
                                            <span class="theme-color">{{ $currency.number_format($r_product->price, 2) }} <small class="text-dark">Negotiable</small></span>
                                        @else
                                            <span class="theme-color">{{ $currency.number_format($r_product->price, 2) }}</span>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Abuse Report Modal -->
<div class="modal fade theme-modal" id="abuseReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('product.report', ['id' => $product->id]) }}">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Abuse Report Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="remove-box">
                    <div class="col-12 mb-4">
                        <select class="form-control" name="title" id="title">
                            <option value="">- - - Report Reason - - -</option>
                            <option value="Product is Illegal/Fradulent">Product is Illegal/Fradulent</option>
                            <option value="The Ad is spam">The Ad is spam</option>
                            <option value="Vendor asked for prepayment">Vendor asked for prepayment</option>
                            <option value="Product price is wrong">Product price is wrong</option>
                            <option value="Vendor is unreachable">Vendor is unreachable</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-12 mb-4">
                        <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Describe the issue here..." required>{{ old('description') }}</textarea>
                    </div>
                    <div class="col-12 mb-4">
                        
                        <input type="hidden" name="email" id="newsletter_email_2">
                        {!! htmlFormSnippet() !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-animation btn-sm fw-bold">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Lightbox Modal -->
<style>
/* Hide the slides by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
  color: #F75709;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
  background-color: rgba(0, 0, 0, 0.8);
}
</style>
<div class="modal theme-modal" id="imageBoxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content" style="background: transparent;">
            <div class="modal-header d-block text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @php $i=1; @endphp
                @foreach($productImages as $image)
                    <div class="mySlides text-center">
                        <div class="numbertext">{{ $i++ .' / '. count($productImages) }}</div>
                        <img src="{{ asset('storage/products/'.$product->seller_id.'/'.$image) }}" style="width:auto; max-height:90vh; max-width:100%;">
                    </div>
                @endforeach
        
                <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
    <script>
        $('#reportBtn').on('click', function(){
            let abuseReportModal = $('#abuseReportModal');
            let modal = bootstrap.Modal.getOrCreateInstance(abuseReportModal);
            modal.show();
        });
        // Open the Modal
        function openModal() {
            let imageBoxModal = $('#imageBoxModal');
            let modal = bootstrap.Modal.getOrCreateInstance(imageBoxModal);
            modal.show();
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>
@endpush