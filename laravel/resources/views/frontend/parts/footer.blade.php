<!-- Footer start -->
<footer class="landing-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">Platform Drone Racing NL</h5>
                    <ul class="list-unstyled footer-list-menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Wedstrijden</a></li>
                        <li><a href="#">Rankings</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">Resources</h5>
                    <ul class="list-unstyled footer-list-menu">
                        <li><a href="#">Whitepaper</a></li>
                        <li><a href="#">Token sales</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">Links</h5>
                    <ul class="list-unstyled footer-list-menu">
                        <li><a href="#">Tokens</a></li>
                        <li><a href="#">Roadmap</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="mb-4 mb-lg-0">
                    <h5 class="mb-3 footer-list-title">Latest News</h5>
                    <div class="blog-post">
                        <a href="#" class="post">
                            <div class="badge bg-soft-success font-size-11 mb-3">Cryptocurrency</div>
                            <h5 class="post-title">Donec pede justo aliquet nec</h5>
                            <p class="mb-0"><i class="bx bx-calendar me-1"></i> 04 Mar, 2020</p>
                        </a>
                        <a href="#" class="post">
                            <div class="badge bg-soft-success font-size-11 mb-3">Cryptocurrency</div>
                            <h5 class="post-title">In turpis, Pellentesque</h5>
                            <p class="mb-0"><i class="bx bx-calendar me-1"></i> 12 Mar, 2020</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <hr class="footer-border my-5">

        <div class="row">
            <img src="{{ URL::asset('/pdrnl/img/brand/logo-white.svg') }}" alt="" height="25">
            <div class="col-lg-6">
                <p class="mb-2">
                    @php echo date("Y"); @endphp © <a href="https://platformdroneracing.nl">PDRNL</a> - @lang('pdrnl.rights').
                </p>
                {{-- <p>It will be as simple as occidental in fact, it will be to an english person, it will seem like
                    simplified English, as a skeptical</p> --}}
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    @auth
                        @if(auth()->user()->hasRole(['manager','supervisor']))
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) | 
                        @endif
                    @endauth
                    @version('compact') |
                    Created <i class="mdi mdi-heart text-danger"></i> by <a href="https://github.com/klaasnicolaas" target="_blank" class="text-reset">klaasnicolaas</a>
                </div>
            </div>

        </div>
    </div>
    <!-- end container -->
</footer>
<!-- Footer end -->