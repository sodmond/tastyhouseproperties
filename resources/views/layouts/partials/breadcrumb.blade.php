<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>{{ $title }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i></a>
                            </li>
                            @if($activePage == 'category' || $activePage == 'product')
                                <li class="breadcrumb-item">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                            @endif
                            @if($activePage == 'category')
                                @if($category->parent != '')
                                    @php 
                                    $parentCat = \App\Models\ProductCategory::find($category->parent);
                                    $catSlug = \App\Models\ProductCategory::getSlug($parentCat->title);
                                    @endphp
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shop.category', ['id' => $parentCat->id, 'slug' => $catSlug]) }}">{{ ucwords(strtolower($parentCat->title)) }}</a>
                                    </li>
                                @endif
                            @endif
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>