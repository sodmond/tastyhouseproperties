<?php

use Illuminate\Support\Str;

if (! function_exists('genrateSlug')) {
    function genrateSlug(array $names) {
        $fullname = implode('-', $names);
        $slug = (trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $fullname)));
        $slug = $slug . '-' . time();
        return strtolower($slug);
    }
}

if (! function_exists('getLocationCookie')) {
    function getLocationCookie() {
        return str_replace(' ', '_', strtolower(config('app.name'))).'_user_location';
    }
}

if (! function_exists('avgRating')) {
    function avgRating($reviews) {
        $numReview = count($reviews);
        if ($numReview < 1) {
            return 0;
        }
        $totalRating = 0;
        foreach ($reviews as $item) {
            $totalRating += $item->rating;
        }
        return round($totalRating/$numReview, 1);
    }
}

if (! function_exists('cartCookie')) {
    function cartCookie() {
        if (isset($_COOKIE['tastyhouse_cart'])) {
            $cart = $_COOKIE['tastyhouse_cart'];
            #$cart = json_encode([]);
            setcookie('tastyhouse_cart', $cart, time() + (86400 * 30));
            return json_decode($cart, true);
        }
        $cart = [];
        setcookie('tastyhouse_cart', json_encode($cart), time() + (86400 * 30));
        return $cart;
    }
}

if (! function_exists('asset2')) {
    function asset2($path, $secure = null)
    {
        return config('app.url2').'/public/'.$path;
    }
}