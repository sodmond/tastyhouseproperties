@extends('layouts.app', ['title' => 'Frequently Asked Questions', 'activePage' => 'faq'])

@section('content')
<!-- Faq Section Start -->
<section class="faq-box-contain section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="faq-contain">
                    <h2>Frequently Asked Questions</h2>
                    <p>Find answers to common questions about our marketplace, from buying and selling to account management and 
                        advert processes. Get the information you need to make the most of your experience with us.
                        <a href="{{ route('contact') }}" class="theme-color text-decoration-underline">contact our support.</a>
                    </p>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="faq-accordion">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    How does Tastyhouse Stores work? 
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Tastyhouse Stores is a <span class="fw-bold">zero-commission</span> online marketplace where vendors 
                                        showcase their products and buyers explore and purchase directly. We provide a 
                                        <span class="fw-bold">platform for trading</span>, but we do not handle transactions, deliveries, 
                                        or direct communication between buyers and sellers.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    How do buyers make payments for products? 
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>All payments are made directly between the buyer and the seller. Tastyhouse Stores does not 
                                        process or facilitate payments. We recommend buyers and sellers choose 
                                        <span class="fw-bold">Safe and reliable</span> payment methods.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    Does Tastyhouse Stores handle delivery? 
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>No, we do not offer delivery services. Sellers are responsible for arranging delivery 
                                        with buyers using their preferred shipping or pickup method.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    What fees do vendors pay to use Tastyhouse Stores? <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We operate on a <span class="fw-bold">zero- commission model</span>, meaning sellers 
                                        keep <span class="fw-bold">100% of their earnings</span>.  Vendors only pay a 
                                        <span class="fw-bold">N5,000 monthly service charge</span> to list their products. 
                                        For those who want extra visibility, our <span class="fw-bold">Prime service</span> is available 
                                        as a separate upgrade for enhanced exposure.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq Section End -->
@endsection