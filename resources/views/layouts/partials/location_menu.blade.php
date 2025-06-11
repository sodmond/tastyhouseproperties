<!-- Location Modal Start -->
<div class="modal location-modal fade theme-modal show" id="locationModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose your Location</h5>
                <p class="mt-1 text-content">Enter your location and we will display products for your area.</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-list">
                    <div class="fs-6 theme-color fw-bold">Current Location: 
                        {{ $th_location_name }}
                    </div>
                    <div class="search-input">
                        <input type="search" class="form-control" id="location-search" placeholder="Search Your Area">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div class="disabled-box" style="justify-content: space-between;">
                        <h6>Select a Location</h6>
                        <button class="btn btn-sm btn-animation" id="back-to-states" style="border-radius:1.25rem;">
                            <small>Back to All States</small></button>
                        <button class="btn btn-sm btn-animation" style="border-radius:1.25rem;" onclick="window.location.href='{{ url('/reset-location') }}'">
                            <small>All Nigeria</small></button>
                    </div>

                    <ul class="location-select custom-height">
                        @foreach($th_states as $state)
                            <li>
                                <a href="javascript:void(0)" class="state">
                                    <h6>{{ $state->name }}</h6>
                                    <span>Cities: {{ count($state->cities) }}</span>
                                    <input type="hidden" value="{{ $state->id }}">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" id="locationFilterUrl" value="{{ url('/get-state-city') }}">
                    <input type="hidden" id="locationChangeUrl" value="{{ url('/change-user-location') }}">
                    <div id="main_location_states" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Location Modal End -->