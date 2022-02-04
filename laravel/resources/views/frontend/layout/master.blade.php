<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.includes.title-meta')
    @include('layouts.includes.head')

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.css') }}">

</head>

<body data-layout="horizontal">
    @show

    @include('sweetalert::alert')

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('frontend.parts.navigation')

        <div class="main-content">
            @yield('header')

            <div>
                @yield('content')
            </div>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('frontend.parts.footer')

    <!-- Features start -->
    {{-- <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">Features</div>
                        <h4>Key features of the product</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row align-items-center pt-4">
                <div class="col-md-6 col-sm-8">
                    <div>
                        <img src="{{ asset('pdrnl') }}/img/svg/user.svg" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <div class="mt-4 mt-md-auto">
                        <div class="d-flex align-items-center mb-2">
                            <div class="features-number font-weight-semibold display-4 me-3">01</div>
                            <h4 class="mb-0">Lending</h4>
                        </div>
                        <p class="text-muted">If several languages coalesce, the grammar of the resulting language is
                            more simple and regular than of the individual will be more simple and regular than the
                            existing.</p>
                        <div class="text-muted mt-4">
                            <p class="mb-2"><i class="mdi mdi-circle-medium text-success me-1"></i>Donec pede justo vel
                                aliquet</p>
                            <p><i class="mdi mdi-circle-medium text-success me-1"></i>Aenean et nisl sagittis</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row align-items-center mt-5 pt-md-5">
                <div class="col-md-5">
                    <div class="mt-4 mt-md-0">
                        <div class="d-flex align-items-center mb-2">
                            <div class="features-number font-weight-semibold display-4 me-3">02</div>
                            <h4 class="mb-0">Wallet</h4>
                        </div>
                        <p class="text-muted">It will be as simple as Occidental; in fact, it will be Occidental. To an
                            English person, it will seem like simplified English, as a skeptical Cambridge friend.</p>
                        <div class="text-muted mt-4">
                            <p class="mb-2"><i class="mdi mdi-circle-medium text-success me-1"></i>Donec pede justo vel
                                aliquet</p>
                            <p><i class="mdi mdi-circle-medium text-success me-1"></i>Aenean et nisl sagittis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6  col-sm-8 ms-md-auto">
                    <div class="mt-4 me-md-0">
                        <img src="{{ asset('pdrnl') }}/img/svg/list.svg" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section> --}}
    <!-- Features end -->

    <!-- Roadmap start -->
    {{-- <section class="section bg-white" id="roadmap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <div class="small-title">Timeline</div>
                        <h4>Our Roadmap</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="hori-timeline" dir="ltr">
                        <div class="owl-carousel owl-theme events navs-carousel" id="timeline-carousel">
                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">December, 2019</div>
                                        <h5 class="mb-4">ICO Platform Idea</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">It will be as simple as occidental in fact it will be
                                            Cambridge</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">January, 2020</div>
                                        <h5 class="mb-4">Research on project</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">To an English person, it will seem like simplified English
                                            existence.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item event-list active">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">February, 2020</div>
                                        <h5 class="mb-4">ICO & Token Design</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">For science, music, sport, etc, Europe uses the same
                                            vocabulary.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">March, 2020</div>
                                        <h5 class="mb-4">ICO Launch Platform</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">New common language will be more simple than existing.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">April, 2020</div>
                                        <h5 class="mb-4">Token sale round 1</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">It will be as simple as occidental in fact it will be
                                            Cambridge</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">May, 2020</div>
                                        <h5 class="mb-4">Token sale round 2</h5>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">To an English person, it will seem like simplified English
                                            existence.</p>
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
    </section> --}}
    <!-- Roadmap end -->

    @include('layouts.includes.vendor-scripts')

    <script src="{{ URL::asset('/assets/libs/jquery-easing/jquery-easing.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ URL::asset('/assets/libs/jquery-countdown/jquery-countdown.min.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.js') }}"></script>

    <!-- ICO landing init -->
    <script src="{{ URL::asset('/assets/js/pages/ico-landing.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

</body>

</html>
