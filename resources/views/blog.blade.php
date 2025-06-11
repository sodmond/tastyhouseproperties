@extends('layouts.app', ['title' => 'Blog', 'activePage' => 'blog'])

@section('content')
<section class="blog-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                <div class="row g-4">
                    @foreach($blog as $article)
                    <div class="col-12">
                        <div class="blog-box blog-list wow fadeInUp">
                            <div class="blog-image">
                                <img src="{{ asset('storage/blog/image/'.$article->image) }}" class="blur-up lazyload" alt="" style="width:100%;">
                            </div>

                            <div class="blog-contain blog-contain-2">
                                <div class="blog-label">
                                    <span class="time"><i data-feather="clock"></i> <span>{{ date('d M, Y H:i', strtotime($article->published_at)) }}</span></span>
                                </div>
                                <a href="{{ route('blog.details', ['id' => $article->id, 'slug' => $article->slug]) }}">
                                    <h3>{{ $article->title }}</h3>
                                </a>
                                <p>
                                    @php echo strip_tags(Illuminate\Support\Facades\Storage::get('public/blog/contents/'.$article->content)); @endphp
                                </p>
                                <button onclick="location.href = '{{ route('blog.details', ['id' => $article->id, 'slug' => $article->slug])}}';" class="blog-button">
                                    Read More <i class="fa-solid fa-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <nav class="custom-pagination">
                    {{ $blog->appends($_GET)->links() }}
                </nav>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                <div class="left-sidebar-box wow fadeInUp">
                    <div class="left-search-box">
                        <div class="search-box">
                            <input type="search" class="form-control" id="exampleFormControlInput1"
                                placeholder="Search....">
                        </div>
                    </div>

                    <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne">
                                    <span>Product Categories</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">

                                    <ul class="category-list custom-padding custom-heigh" style="max-height:100vw;">
                                        @foreach($th_categories1 as $cat1)
                                        <li>
                                            <div class="form-check ps-0 m-0 category-list-box">
                                                <label class="form-check-label" for="fruit">
                                                    @php $catSlug = \App\Models\ProductCategory::getSlug($cat1->title); @endphp
                                                    <img src="{{ asset($cat1->icon) }}" alt="" style="max-width:20px; margin-right:5px;">
                                                    <a class="name" href="{{ route('shop.category', ['id' => $cat1->id, 'slug' => $catSlug]) }}">{{ ucwords(strtolower($cat1->title)) }}</a>
                                                    {{--<span class="number">(15)</span>--}}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{--<div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne">
                                    Recent Post
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body pt-0">
                                    <div class="recent-post-box">
                                        @foreach($blog as $article)
                                        <div class="recent-box">
                                            <a href="{{ route('blog.details', ['id' => $article->id, 'slug' => $article->slug]) }}" class="recent-image">
                                                <img src="{{ asset('storage/blog/image/'.$article->image) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <div class="recent-detail">
                                                <a href="{{ route('blog.details', ['id' => $article->id, 'slug' => $article->slug]) }}">
                                                    <h5 class="recent-name">{{ $article->title }}</h5>
                                                </a>
                                                <h6>{{ date('d M, Y', strtotime($article->published_at)) }}</h6>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection