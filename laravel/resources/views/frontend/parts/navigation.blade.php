<nav class="navbar navbar-light navbar-expand-lg navigation fixed-top sticky">
    <div class="container">
        <div class="d-flex">
            <!-- Brand logo -->
            <a class="navbar-logo" href="{{ route('root') }}">
                <img src="{{ URL::asset('/pdrnl/img/brand/pdrnl_dark_color.png') }}" alt="Company logo" height="25" class="logo logo-dark">
                <img src="{{ URL::asset('/pdrnl/img/brand/pdrnl_white_color.png') }}" alt="Company logo" height="25" class="logo logo-light">
            </a>
        </div>
        <div class="d-flex">
            <!-- Language -->
            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch(LaravelLocalization::getCurrentLocale())
                        @case('de')
                            <img src="{{ URL::asset('/assets/images/flags/de.png')}}" alt="Header Language" height="16"> <span class="align-middle">Deutsch</span>
                        @break
                        @case('nl')
                            <img src="{{ URL::asset('/assets/images/flags/nl.png')}}" alt="Header Language" height="16">
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

            <!-- Mobile nav toggle icon -->
            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>


        <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav ms-auto">
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
            <hr>
            <div class="row mb-3 mb-lg-0">
                <div class="col text-center">
                    <div class="my-2 ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-success w-xs">@lang('auth.login')</a>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="my-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-warning w-xs">@lang('auth.register')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>