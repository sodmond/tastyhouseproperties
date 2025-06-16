<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="{{ url('/') }}">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="">
            <a href="#" class="navbar-toggler-icon-2">
                <i class="iconly-Category icli js-link"></i>
                <span>Category</span>
            </a>
        </li>

        <li>
            <a href="{{ route('shop.search') }}" class="search-box">
                <i class="iconly-Search icli"></i>
                <span>Search</span>
            </a>
        </li>

        <li>
            <a href="{{ route('user.wishlist') }}" class="notifi-wishlist">
                <i class="iconly-Heart icli"></i>
                <span>My Wish</span>
            </a>
        </li>

        <li>
            <a href="{{ route('shop') }}">
                <i class="iconly-Bag-2 icli fly-cate"></i>
                <span>Properties</span>
            </a>
        </li>
    </ul>
</div>