<!-- ========== Horizontal menu Start ========== -->
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <!-- Brand logo -->
            @include('layouts.navbars.snippets.logo')

            <!-- Mobile nav toggle icon -->
            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="{{ __('Search') }}...">
                    <span class="uil-search"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">
            <!-- Search -->
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ __('Search') }}..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Language -->
            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch(LaravelLocalization::getCurrentLocale())
                        @case('de')
                            <img src="{{ URL::asset('/assets/images/flags/de.png')}}" alt="Header Language" height="16"> <span class="align-middle">Deutsch</span>
                        @break
                        @case('nl')
                            <img src="{{ URL::asset('/assets/images/flags/nl.png')}}" alt="Header Language" height="16"> <span class="align-middle">Nederlands</span>
                        @break
                        @default
                            <img src="{{ URL::asset('/assets/images/flags/en.png')}}" alt="Header Language" height="16"> <span class="align-middle">English</span>
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" type="button" rel="alternate" hreflang="{{ $localeCode }}" {{$localeCode == LaravelLocalization::getCurrentLocale() ? 'style=background-color:#f39200;color:white;' : ''}} href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img src="{{ URL::asset('assets/images/flags/'.$localeCode.'.png')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">{{ $properties['native'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Profile -->
            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="@if(!empty(auth()->user()->image)) {{ asset('storage') }}/images/profiles/{{auth()->user()->image}} @else {{ asset('pdrnl') }}/img/default.png @endif"
                        alt="Header Avatar">
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- Profile -->
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i>
                        <span class="align-middle">@lang('translation.View_Profile')</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('layout') }}">
                        <i class="mdi mdi-view-dashboard-variant-outline font-size-18 align-middle text-muted me-1"></i>
                        <span class="align-middle">Change layout</span>
                    </a>
                    <a class="dropdown-item d-block right-bar-toggle" href="#">
                        <i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">@lang('translation.Settings')</span>
                        <span class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span>
                    </a>
                    <hr class="dropdown-divider">
                    <!-- Log out -->
                    <a class="dropdown-item logout-form" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">@lang('translation.Sign_out')</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div> --}}

        </div>
    </div>

    <!-- Menu -->
    <div class="container-fluid">
        <div class="topnav">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('root') ? 'active' : '' }}" href="{{ route('root')}}">
                                <i class="fas fa-home me-2"></i>
                                <span class="nav-link-inner--text">@lang('menu.home')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed(['events','events.*']) ? 'active' : '' }}" href="{{ route('events') }}">
                                <i class="uil-calendar-alt me-2"></i> @lang('menu.competitions')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">
                                <i class="fas fa-envelope me-2"></i>
                                <span class="nav-link-inner--text">@lang('menu.contact')</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-key me-2"></i>
                                <span class="nav-link-inner--text">@lang('auth.login')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-circle me-2"></i>
                                <span class="nav-link-inner--text">@lang('auth.register')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>