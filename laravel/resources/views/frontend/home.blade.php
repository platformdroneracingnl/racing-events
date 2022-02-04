@extends('frontend.layout.master')

@section('title')
    Home
@endsection

@section('header')
    <!-- hero section start -->
    <section class="section hero-section bg-ico-hero">
        {{-- <div class="bg-overlay bg-primary"></div> --}}
        <span class="mask bg-gradient-default bg-primary opacity-7"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="text-white-50">
                        <h1 class="text-light fw-semibold mb-3 hero-title">Event Registrations</h1>
                        <p class="font-size-14" style="color:white;">Nog nooit was het zo makkelijk om in te schrijven voor een drone wedstrijden en met een QR Code checkin op de wedstrijd dag.</p>

                        <div class="button-items mt-4">
                            <a href="#" class="btn btn-success">Maak account aan</a>
                            <a href="#" class="btn btn-light">Meer info</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-sm-10 ms-lg-auto">
                    <div class="card overflow-hidden mb-0 mt-5 mt-lg-0">
                        <div class="card-header text-center">
                            <h5 class="mb-0">ICO Countdown time</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">

                                <h5>Time left to Ico :</h5>
                                <div class="mt-4">
                                    <div data-countdown="2021/12/31" class="counter-number ico-countdown"></div>
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-success w-md">Get Token</button>
                                </div>

                                <div class="mt-5">
                                    {{-- <h4 class="font-weight-semibold">1 ETH = 2235 SKT</h4> --}}
                                    <div class="clearfix mt-4">
                                        <h5 class="float-end font-size-14">5234.43</h5>
                                    </div>
                                    <div class="progress p-1 progress-xl softcap-progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 15%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-label">15 %</div>
                                        </div>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-label">30 %</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- hero section end -->
@endsection

@section('content')
    <!-- currency price section start -->
    <section class="section bg-white p-0">
        <div class="container">
            <div class="platform-features">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/user.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ __('Easy registration for competitions') }}</h4>
                                <p class="card-text text-center">{{ __('Create an account and register for competitions, registering has never been easier.') }}</p>
                            </div>
                            <!-- <div class="card-body">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-soft-warning text-warning font-size-18">
                                            <i class="mdi mdi-bitcoin"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-muted">Bitcoin</p>
                                        <h5>$ 9134.39</h5>
                                        <p class="text-muted text-truncate mb-0">+ 0.0012.23 ( 0.2 % ) <i
                                                class="mdi mdi-arrow-up ms-1 text-success"></i></p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/list.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ __('Clear management for organizers') }}</h4>
                                <p class="card-text text-center"> {{ __('As the organizer of a competition you have all registrations in a row and you decide when a registration is opened.') }}</p>
                            </div>
                            <!-- <div class="card-body">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="mdi mdi-ethereum"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-muted">Ethereum</p>
                                        <h5>$ 245.44</h5>
                                        <p class="text-muted text-truncate mb-0">- 004.12 ( 0.1 % ) <i
                                                class="mdi mdi-arrow-down ms-1 text-danger"></i></p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/check.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ __('Digital check-in') }}</h4>
                                <p class="card-text text-center">{{ __('No more paper registration lists! Checking in is done via a QR code, which you have scanned by the organizer.') }}</p>
                            </div>
                            <!-- <div class="card-body">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-soft-info text-info font-size-18">
                                            <i class="mdi mdi-litecoin"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-muted">Litecoin</p>
                                        <h5>$ 63.61</h5>
                                        <p class="text-muted text-truncate mb-0">+ 0.0001.12 ( 0.1 % ) <i
                                                class="mdi mdi-arrow-up ms-1 text-success"></i></p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- currency price section end -->

    <!-- about section start -->
    <section class="section pt-4 bg-white" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">About us</div>
                        <h4>What is ICO Token?</h4>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5">

                    <div class="text-muted">
                        <h4>Best ICO for your cryptocurrency business</h4>
                        <p>If several languages coalesce, the grammar of the resulting that of the individual new common
                            language will be more simple and regular than the existing.</p>
                        <p class="mb-4">It would be necessary to have uniform pronunciation.</p>

                        <div class="button-items">
                            <a href="#" class="btn btn-success">Read More</a>
                            <a href="#" class="btn btn-outline-primary">How It work</a>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-4 col-6">
                                <div class="mt-4">
                                    <h4>$ 6.2 M</h4>
                                    <p>Invest amount</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="mt-4">
                                    <h4>16245</h4>
                                    <p>Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 ms-auto">
                    <div class="mt-4 mt-lg-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <i class="mdi mdi-bitcoin h2 text-success"></i>
                                        </div>
                                        <h5>Lending</h5>
                                        <p class="text-muted mb-0">At vero eos et accusamus et iusto blanditiis</p>

                                    </div>
                                    <div class="card-footer bg-transparent border-top text-center">
                                        <a href="#" class="text-primary">Learn more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card border mt-lg-5">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <i class="mdi mdi-wallet-outline h2 text-success"></i>
                                        </div>
                                        <h5>Wallet</h5>
                                        <p class="text-muted mb-0">Quis autem vel eum iure reprehenderit</p>

                                    </div>
                                    <div class="card-footer bg-transparent border-top text-center">
                                        <a href="#" class="text-primary">Learn more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            {{-- <hr class="my-5"> --}}

            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme clients-carousel" id="clients-carousel" dir="ltr">
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/1.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/2.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/3.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/4.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/5.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-images">
                                <img src="{{ URL::asset('/assets/images/clients/6.png') }}" alt="client-img"
                                    class="mx-auto img-fluid d-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- about section end -->

    <!-- Team start -->
    <section class="section" id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">Team</div>
                        <h4>Meet our team</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="col-lg-12">
                <div class="owl-carousel owl-theme events navs-carousel" id="team-carousel" dir="ltr">
                    <div class="item">
                        <div class="card text-center team-box">
                            <div class="card-body">
                                <div>
                                    <img src="{{ URL::asset('/assets/images/users/avatar-2.jpg') }}" alt="" class="rounded">
                                </div>

                                <div class="mt-3">
                                    <h5>Mark Hurley</h5>
                                    <P class="text-muted mb-0">CEO & Lead</P>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="d-flex mb-0 team-social-links" id="tooltip-container">
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container"
                                            title="Facebook">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container"
                                            title="Linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container"
                                            title="Google">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card text-center team-box">
                            <div class="card-body">
                                <div>
                                    <img src="{{ URL::asset('/assets/images/users/avatar-3.jpg') }}" alt="" class="rounded">
                                </div>

                                <div class="mt-3">
                                    <h5>Calvin Smith</h5>
                                    <P class="text-muted mb-0">Blockchain developer</P>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="d-flex mb-0 team-social-links" id="tooltip-container2">
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container2"
                                            title="Facebook">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container2"
                                            title="Linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container2"
                                            title="Google">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card text-center team-box">
                            <div class="card-body">
                                <div>
                                    <img src="{{ URL::asset('/assets/images/users/avatar-8.jpg') }}" alt="" class="rounded">
                                </div>
                                <div class="mt-3">
                                    <h5>Vickie Sample</h5>
                                    <P class="text-muted mb-0">Designer</P>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="d-flex mb-0 team-social-links" id="tooltip-container3">
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container3"
                                            title="Facebook">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container3"
                                            title="Linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container3"
                                            title="Google">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card text-center team-box">
                            <div class="card-body">
                                <div>
                                    <img src="{{ URL::asset('/assets/images/users/avatar-5.jpg') }}" alt="" class="rounded">
                                </div>

                                <div class="mt-3">
                                    <h5>Alma Farley</h5>
                                    <P class="text-muted mb-0">App developer</P>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="d-flex mb-0 team-social-links" id="tooltip-container4">
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container4"
                                            title="Facebook">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container4"
                                            title="Linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container4"
                                            title="Google">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="card text-center team-box">
                            <div class="card-body">
                                <div>
                                    <img src="{{ URL::asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="rounded">
                                </div>

                                <div class="mt-3">
                                    <h5>Amy Hood </h5>
                                    <P class="text-muted mb-0">Designer</P>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <div class="d-flex mb-0 team-social-links" id="tooltip-container5">
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container5"
                                            title="Facebook">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container5"
                                            title="Linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-container="#tooltip-container5"
                                            title="Google">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- Team end -->

    <!-- Blog start -->
    <section class="section bg-white" id="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">Blog</div>
                        <h4>Latest News</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-4 col-sm-6">
                    <div class="blog-box mb-4 mb-xl-0">
                        <div class="position-relative">
                            <img src="{{ URL::asset('/assets/images/crypto/blog/img-1.jpg') }}" alt=""
                                class="rounded img-fluid mx-auto d-block">
                            <div class="badge bg-success blog-badge font-size-11">Cryptocurrency</div>
                        </div>

                        <div class="mt-4 text-muted">
                            <p class="mb-2"><i class="bx bx-calendar me-1"></i> 04 Mar, 2020</p>
                            <h5 class="mb-3">Donec pede justo, fringilla vele</h5>
                            <p>If several languages coalesce, the grammar of the resulting language</p>

                            <div>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="blog-box mb-4 mb-xl-0">

                        <div class="position-relative">
                            <img src="{{ URL::asset('/assets/images/crypto/blog/img-2.jpg') }}" alt=""
                                class="rounded img-fluid mx-auto d-block">
                            <div class="badge bg-success blog-badge font-size-11">Cryptocurrency</div>
                        </div>

                        <div class="mt-4 text-muted">
                            <p class="mb-2"><i class="bx bx-calendar me-1"></i> 12 Feb, 2020</p>
                            <h5 class="mb-3">Aenean ut eros et nisl</h5>
                            <p>Everyone realizes why a new common language would be desirable</p>

                            <div>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="blog-box mb-4 mb-xl-0">
                        <div class="position-relative">
                            <img src="{{ URL::asset('/assets/images/crypto/blog/img-3.jpg') }}" alt=""
                                class="rounded img-fluid mx-auto d-block">
                            <div class="badge bg-success blog-badge font-size-11">Cryptocurrency</div>
                        </div>

                        <div class="mt-4 text-muted">
                            <p class="mb-2"><i class="bx bx-calendar me-1"></i> 06 Jan, 2020</p>
                            <h5 class="mb-3">In turpis, pellentesque posuere</h5>
                            <p>To an English person, it will seem like simplified English, as a skeptical Cambridge</p>

                            <div>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- Blog end -->

    <!-- Faqs start -->
    <section class="section" id="faqs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">FAQs</div>
                        <h4>Frequently asked questions</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="vertical-nav">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4">
                                <div class="nav flex-column nav-pills" role="tablist">
                                    <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill"
                                        href="#v-pills-gen-ques" role="tab">
                                        <i class="bx bx-help-circle nav-icon d-block mb-2"></i>
                                        <p class="font-weight-bold mb-0">General Questions</p>
                                    </a>
                                    <a class="nav-link" id="v-pills-token-sale-tab" data-bs-toggle="pill"
                                        href="#v-pills-token-sale" role="tab">
                                        <i class="bx bx-receipt nav-icon d-block mb-2"></i>
                                        <p class="font-weight-bold mb-0">Token sale</p>
                                    </a>
                                    <a class="nav-link" id="v-pills-roadmap-tab" data-bs-toggle="pill"
                                        href="#v-pills-roadmap" role="tab">
                                        <i class="bx bx-timer d-block nav-icon mb-2"></i>
                                        <p class="font-weight-bold mb-0">Roadmap</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="v-pills-gen-ques"
                                                role="tabpanel">
                                                <h4 class="card-title mb-4">General Questions</h4>

                                                <div>
                                                    <div id="gen-ques-accordion" class="accordion custom-accordion">
                                                        <div class="mb-3">
                                                            <a href="#general-collapseOne" class="accordion-list"
                                                                data-bs-toggle="collapse" aria-expanded="true"
                                                                aria-controls="general-collapseOne">

                                                                <div>What is Lorem Ipsum ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>

                                                            </a>

                                                            <div id="general-collapseOne" class="collapse show"
                                                                data-bs-parent="#gen-ques-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">Everyone realizes why a new common
                                                                        language would be desirable: one could refuse to
                                                                        pay expensive translators. To achieve this, it
                                                                        would be necessary to have uniform grammar,
                                                                        pronunciation and more common words.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <a href="#general-collapseTwo"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="general-collapseTwo">
                                                                <div>Why do we use it ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="general-collapseTwo" class="collapse"
                                                                data-bs-parent="#gen-ques-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">If several languages coalesce, the
                                                                        grammar of the resulting language is more simple
                                                                        and regular than that of the individual
                                                                        languages. The new common language will be more
                                                                        simple and regular than the existing European
                                                                        languages.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <a href="#general-collapseThree"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="general-collapseThree">
                                                                <div>Where does it come from ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="general-collapseThree" class="collapse"
                                                                data-bs-parent="#gen-ques-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">It will be as simple as Occidental;
                                                                        in fact, it will be Occidental. To an English
                                                                        person, it will seem like simplified English, as
                                                                        a skeptical Cambridge friend of mine told me
                                                                        what Occidental.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <a href="#general-collapseFour"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="general-collapseFour">
                                                                <div>Where can I get some ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="general-collapseFour" class="collapse"
                                                                data-bs-parent="#gen-ques-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">To an English person, it will seem
                                                                        like simplified English, as a skeptical
                                                                        Cambridge friend of mine told me what Occidental
                                                                        is. The European languages are members of the
                                                                        same family. Their separate existence is a myth.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-token-sale" role="tabpanel">
                                                <h4 class="card-title mb-4">Token sale</h4>

                                                <div>
                                                    <div id="token-accordion" class="accordion custom-accordion">
                                                        <div class="mb-3">
                                                            <a href="#token-collapseOne"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="token-collapseOne">
                                                                <div>Why do we use it ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="token-collapseOne" class="collapse"
                                                                data-bs-parent="#token-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">If several languages coalesce, the
                                                                        grammar of the resulting language is more simple
                                                                        and regular than that of the individual
                                                                        languages. The new common language will be more
                                                                        simple and regular than the existing European
                                                                        languages.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <a href="#token-collapseTwo" class="accordion-list"
                                                                data-bs-toggle="collapse" aria-expanded="true"
                                                                aria-controls="token-collapseTwo">

                                                                <div>What is Lorem Ipsum ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>

                                                            </a>

                                                            <div id="token-collapseTwo" class="collapse show"
                                                                data-bs-parent="#token-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">Everyone realizes why a new common
                                                                        language would be desirable: one could refuse to
                                                                        pay expensive translators. To achieve this, it
                                                                        would be necessary to have uniform grammar,
                                                                        pronunciation and more common words.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <a href="#token-collapseThree"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="token-collapseThree">
                                                                <div>Where can I get some ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="token-collapseThree" class="collapse"
                                                                data-bs-parent="#token-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">To an English person, it will seem
                                                                        like simplified English, as a skeptical
                                                                        Cambridge friend of mine told me what Occidental
                                                                        is. The European languages are members of the
                                                                        same family. Their separate existence is a myth.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <a href="#token-collapseFour"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="token-collapseFour">
                                                                <div>Where does it come from ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="token-collapseFour" class="collapse"
                                                                data-bs-parent="#token-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">It will be as simple as Occidental;
                                                                        in fact, it will be Occidental. To an English
                                                                        person, it will seem like simplified English, as
                                                                        a skeptical Cambridge friend of mine told me
                                                                        what Occidental.</p>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-roadmap" role="tabpanel">
                                                <h4 class="card-title mb-4">Roadmap</h4>

                                                <div>
                                                    <div id="roadmap-accordion" class="accordion custom-accordion">

                                                        <div class="mb-3">
                                                            <a href="#roadmap-collapseOne" class="accordion-list"
                                                                data-bs-toggle="collapse" aria-expanded="true"
                                                                aria-controls="roadmap-collapseOne">



                                                                <div>Where can I get some ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>

                                                            </a>

                                                            <div id="roadmap-collapseOne" class="collapse show"
                                                                data-bs-parent="#roadmap-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">Everyone realizes why a new common
                                                                        language would be desirable: one could refuse to
                                                                        pay expensive translators. To achieve this, it
                                                                        would be necessary to have uniform grammar,
                                                                        pronunciation and more common words.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <a href="#roadmap-collapseTwo"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="roadmap-collapseTwo">
                                                                <div>What is Lorem Ipsum ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="roadmap-collapseTwo" class="collapse"
                                                                data-bs-parent="#roadmap-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">If several languages coalesce, the
                                                                        grammar of the resulting language is more simple
                                                                        and regular than that of the individual
                                                                        languages. The new common language will be more
                                                                        simple and regular than the existing European
                                                                        languages.</p>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="mb-3">
                                                            <a href="#roadmap-collapseThree"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="roadmap-collapseThree">
                                                                <div>Why do we use it ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="roadmap-collapseThree" class="collapse"
                                                                data-bs-parent="#roadmap-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">To an English person, it will seem
                                                                        like simplified English, as a skeptical
                                                                        Cambridge friend of mine told me what Occidental
                                                                        is. The European languages are members of the
                                                                        same family. Their separate existence is a myth.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <a href="#roadmap-collapseFour"
                                                                class="accordion-list collapsed"
                                                                data-bs-toggle="collapse" aria-expanded="false"
                                                                aria-controls="roadmap-collapseFour">
                                                                <div>Where does it come from ?</div>
                                                                <i class="mdi mdi-minus accor-plus-icon"></i>
                                                            </a>
                                                            <div id="roadmap-collapseFour" class="collapse"
                                                                data-bs-parent="#roadmap-accordion">
                                                                <div class="card-body">
                                                                    <p class="mb-0">It will be as simple as Occidental;
                                                                        in fact, it will be Occidental. To an English
                                                                        person, it will seem like simplified English, as
                                                                        a skeptical Cambridge friend of mine told me
                                                                        what Occidental.</p>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end vertical nav -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- Faqs end -->
@endsection