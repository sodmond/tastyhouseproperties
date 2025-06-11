<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="TastyHouse Stores- the marketplace built for vendors, designed for success.">
    <meta name="keywords"
        content="tastyhouse, stores, admin dashboard, tastyhouse stores, marketplace, online marketplace, vendors, buyers, customers, digital commerce, ecommerce, products, quality products, online shopping, customer satisfaction">
    <meta name="author" content="WMA Tech Junkies">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} - Admin</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/custom.css') }}">
</head>

<body>

    <!-- login section start -->
    <section class="log-in-section section-b-space">
        <a href="" class="logo-login"><img src="{{ asset('img/logo.png') }}" class="img-fluid"></a>
        <div class="container w-100">
            <div class="row">

                <div class="col-xl-5 col-lg-6 me-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <!-- login section end -->

</body>

</html>