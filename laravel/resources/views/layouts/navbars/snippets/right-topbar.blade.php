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

<!-- Extra options in grid -->
<div class="dropdown d-none d-lg-inline-block ms-1">
    <button type="button" class="btn header-item noti-icon waves-effect"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="uil-apps"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <div class="px-lg-2">
            <div class="row g-0">
                <div class="col">
                    <a class="dropdown-icon-item" href="#">
                        <i class="mdi mdi-information-outline fa-2x"></i>
                        <span>Documentation</span>
                    </a>
                </div>
                <div class="col">
                    <a class="dropdown-icon-item" href="{{ route('layout') }}">
                        <i class="mdi mdi-view-dashboard-variant-outline fa-2x"></i>
                        <span>Layout</span>
                    </a>
                </div>
                <div class="col">
                    <a class="dropdown-icon-item" href="#">
                        <i class="mdi mdi-github fa-2x"></i>
                        <span>Development</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fullscreen -->
<div class="dropdown d-none d-lg-inline-block ms-1">
    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
        <i class="uil-minus-path"></i>
    </button>
</div>

<!-- Notifications -->
<div class="dropdown d-inline-block">
    <!-- Notification Bell -->
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="uil-bell"></i>
        <!-- Counter -->
        @if (auth()->user()->unreadNotifications->count() != 0)
            <span class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
    </button>
    <!-- Dropdown -->
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <!-- Notification counter -->
                <div class="col">
                    <h5 class="m-0 font-size-16"> 
                        @if (auth()->user()->unreadNotifications->count() == 1)
                            @lang('pdrnl.notify_nr_single', ['number' => auth()->user()->unreadNotifications->count()])
                        @else
                            @lang('pdrnl.notify_nr_multi', ['number' => auth()->user()->unreadNotifications->count()])
                        @endif
                    </h5>
                </div>
                <!-- Mark all as read -->
                <div class="col-auto">
                    <a href="{{ route('markRead') }}" class="small"> @lang('translation.Mark_read')</a>
                </div>
            </div>
        </div>
        <!-- List group -->
        <div data-simplebar style="max-height: 250px;">
            @foreach (auth()->user()->unreadNotifications as $notification)
                <a href="{{ route('notify.show', $notification->id) }}" class="text-reset notification-item">
                    <div class="d-flex align-items-start">
                        <!-- icon -->
                        <div class="avatar-xs me-3">
                            <span class="avatar-title bg-warning rounded-circle font-size-16">
                                <i class="uil-info-circle"></i>
                            </span>
                        </div>
                        <!-- Information -->
                        <div class="flex-1">
                            <h6 class="mt-0 mb-1">
                                @if (isset($notification->data['title']) != null)
                                    {{ $notification->data['title'] }}
                                @else
                                    Platform Drone Racing NL
                                @endif
                            </h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">
                                    @if ($notification->data['type'] == "registration")
                                        {{ __($notification->data['message']) }} <b>{{ __($notification->data['status']) }}</b>
                                    @else
                                        {{ __($notification->data['message']) }}
                                    @endif
                                </p>
                                <p class="mb-0">
                                    <i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <!-- View more -->
        <div class="p-2 border-top d-grid">
            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('notify.index') }}">
                <i class="uil-arrow-circle-right me-1"></i> {{ __('View More') }}..
            </a>
        </div>
    </div>
</div>

<!-- Profile -->
<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="@if(!empty(auth()->user()->image)) {{ asset('storage') }}/images/profiles/{{auth()->user()->image}} @else {{ asset('pdrnl') }}/img/default.png @endif"
            alt="Header Avatar">
        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{Str::ucfirst(Auth::user()->name)}}</span>
        <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <a class="dropdown-item" href="{{ route('profile.show') }}">
            <i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> 
            <span class="align-middle">@lang('translation.View_Profile')</span>
        </a>
        {{-- <a class="dropdown-item" href="#"><i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">@lang('translation.My_Wallet')</span></a> --}}
        <a class="dropdown-item d-block right-bar-toggle" href="#">
            <i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i>
            <span class="align-middle">@lang('translation.Settings')</span>
            <span class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span>
        </a>
        <a class="dropdown-item" href="#">
            <i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i>
            <span class="align-middle">@lang('translation.Lock_screen')</span></a>
        <a class="dropdown-item logout-form" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
            <span class="align-middle">@lang('translation.Sign_out')</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<!-- Settings -->
{{-- <div class="dropdown d-inline-block">
    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
        <i class="uil-cog"></i>
    </button>
</div> --}}