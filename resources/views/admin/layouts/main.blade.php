<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="TastyHouse Stores Admin Portal - the marketplace built for vendors, designed for success.">
    <meta name="keywords"
        content="tastyhouse, stores, admin dashboard, tastyhouse stores, marketplace, online marketplace, vendors, buyers, customers, digital commerce, ecommerce, products, quality products, online shopping, customer satisfaction">
    <meta name="author" content="WMA Tech Junkies">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} - Admin - {{ $title }}</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{ asset('backend/css/linearicon.css') }}">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/font-awesome.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/datatables.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/themify.css') }}">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/ratio.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/remixicon.css') }}">

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dropzone.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/feather-icon.css') }}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.min.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/bootstrap.css') }}">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vendors/bootstrap-tagsinput.css') }}">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/vector-map.css') }}">

    <!-- Slick Slider Css -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors/slick.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
    <link href="{{ asset('css/richtext.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/custom.css') }}">
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('admin.layouts.partials.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('admin.layouts.partials.sidebar')
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">
                @yield('content')
                <!-- Container-fluid Ends-->

                <!-- footer start-->
                <div class="container-fluid">
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                <p class="mb-0">Copyright {{ date('Y') }} © {{ config('app.name') }}</p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn  btn--yes btn-danger">Yes</button>
                    </div>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- latest js -->
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('backend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('backend/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('backend/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('backend/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('backend/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar jquery -->
    <script src="{{ asset('backend/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('backend/js/tooltip-init.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('backend/js/sidebar-menu.js') }}"></script>
    {{--<script src="{{ asset('backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('backend/js/notify/index.js') }}"></script>--}}

    <!-- Apexchar js -->
    <script src="{{ asset('backend/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('backend/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('backend/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('backend/js/chart/apex-chart/chart-custom1.js') }}"></script>


    @if($activePage == 'home')
    <!-- slick slider js -->
    <script src="{{ asset('backend/js/slick.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom-slick.js') }}"></script>
    @else
    <!-- bootstrap tag-input js -->
    {{--<script src="{{ asset('backend/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/js/sidebar-menu.js') }}"></script>--}}
    @endif

    <!-- customizer js -->
    {{--<script src="{{ asset('backend/js/customizer.js') }}"></script>--}}

    <!--Dropzon js -->
    <script src="{{ asset('backend/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('backend/js/dropzone/dropzone-script.js') }}"></script>

    <!-- ratio js -->
    <script src="{{ asset('backend/js/ratio.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('backend/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('backend/js/checkbox-all-check.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2-custom.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('backend/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('backend/js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>
    <script>
        $(document).ready(function(){ 
            var input_group = $('input[required]').parent();
            input_group.parent().find('label').addClass('required');
            var select_group = $('select[required]').parent();
            select_group.parent().find('label').addClass('required');
            var textarea_group = $('textarea[required]').parent();
            textarea_group.parent().find('label').addClass('required');
        });
    </script>
    @stack('custom-scripts')
</body>

</html>