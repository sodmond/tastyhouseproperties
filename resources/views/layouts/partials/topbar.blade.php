<div class="header-top">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-3 col-7 d-xxl-block">
                <div class="top-left-header">
                    <i class="iconly-Location icli text-white"></i>
                    <span class="text-white">{{ $th_location_name }}</span>
                </div>
            </div>

            <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                <div class="header-offer">
                    <div class="notification-slider">
                        <div>
                            <div class="timer-notification">
                                <h6><strong class="me-1">Advertise on TastyHouse!</strong>Drive targeted traffic directly to your products or services with strategically placed ads.
                                </h6>
                            </div>
                        </div>

                        <div>
                            <div class="timer-notification">
                                <h6>Maximize your brand's visibility by securing prime advert space on our high-traffic website!
                                    <a href="{{ route('advertise') }}" class="text-white">Contact</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 d-sm-block d-lg-none">
                <ul class="about-list right-nav-about">
                    <li class="right-nav-list">
                        <div class="dropdown theme-form-select">
                            <a class="btn text-white" style="border:1px solid #FFF;" href="{{ route('seller.product.new') }}">
                                <i class="fa fa-plus-circle"></i> SELL
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>