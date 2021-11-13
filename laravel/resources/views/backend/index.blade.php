@extends('layouts.backend.master')

@section('title')
    Dashboard
@endsection

@php
    use App\Http\Controllers\Pilots\RegistrationController;
    use App\Http\Controllers\CountController;
    use Carbon\Carbon;
@endphp

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') PDRNL @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="uil-shutter-alt spin-icon"></i>
            </div>
        </div>
    </div>

    <div class="row">
        @if ($agent->isMobile() == false)
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="total-revenue-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ CountController::getTotalEvents() }}</span></h4>
                            <p class="text-muted mb-0">Gehouden wedstrijden</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ CountController::getTotalUsers() }}</span></h4>
                            <p class="text-muted mb-0">Aantal gebruikers</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="customers-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ CountController::getTotalRegistrations() }}</span></h4>
                            <p class="text-muted mb-0">Aantal inschrijvingen</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-6 col-xl-3">
            @if (empty(auth()->user()->country) or empty(auth()->user()->pilot_name))
                <a href="{{ route('profile.show', '#changeprofile') }}">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1 mt-1" style="color: white">Profiel is <b>incompleet</b> <i class="mdi mdi-account-alert-outline"></i></h4>
                                <p class="mb-0" style="color: white">Er ontbreken nog gegevens op je profiel</p>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <div class="card bg-success">
                    <div class="card-body">
                        <div>
                            <h4 class="mb-1 mt-1" style="color: white">Profiel is <b>compleet</b> <i class="mdi mdi-account-check-outline"></i></h4>
                            <p class="mb-0" style="color: white">Je kan inschrijven voor wedstrijden</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 class="card-title mb-4">{{ __('Last 5 matches') }}</h4>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <a href="{{ route('events') }}" class="btn btn-sm btn-primary btn-on-mobile mb-4">{{ __('View more competitions') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive mb-4">
                            <table class="table table-centered table-nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">@lang('category/events.competition')</th>
                                        <th scope="col">@lang('category/events.organizer')</th>
                                        <th scope="col">@lang('category/events.date')</th>
                                        <th scope="col">@lang('category/events.start_registration')</th>
                                        <th scope="col">Pilots <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Number of registrations / Maximum number') }}"></i></th>
                                        <th scope="col">@lang('category/events.price')</th>
                                        <th scope="col">@lang('button.options')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration }}
                                                <!-- Als aanmaak datum event groter is of gelijk aan dan dag vandaag -->
                                                @if ($event->start_registration->format('Y-m-d') >= Carbon::today()->subWeek()->toDateString())
                                                    <!-- Alleen de eerste week word deze label getoond -->
                                                    <span class="badge bg-warning">@lang('category/events.new')</span>
                                                @endif
                                            </td>
                                            <td>{{ $event->name }}</td>
                                            <!-- Organizator -->
                                            <td>
                                                @if (isset($event->organization_id))
                                                    {{ $event->organization->name }}
                                                @else
                                                    {{ $event->user->name }}
                                                @endif
                                            </td>
                                            <!-- Event date -->
                                            <td>{{ $event->date->format('d-m-Y') }}</td>
                                            <td>{{ $event->start_registration->format('d-m-Y') }}</td>
                                            <!-- Aantal inschrijvingen / maximum aantal inschrijvingen -->
                                            <td>
                                                {{ RegistrationController::countRegistrations($event->id) }} / {{ $event->max_registrations }}
                                                @if ($event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                                    <span class="badge badge-success">{{ __('Waitlist') }}</span>
                                                @elseif (RegistrationController::countRegistrations($event->id) == $event->max_registrations)
                                                    <span class="badge badge-warning">@lang('category/events.full')!</span>
                                                @endif
                                            </td>
                                            <!-- Price -->
                                            <td>
                                                @if ($event->price == 0)
                                                    {{ __('Free') }}!
                                                @else
                                                    €{{ number_format($event->price, 2) }}
                                                @endif
                                            </td>
                                            <!-- Options -->
                                            <td>
                                                <a class="btn btn-sm btn-primary ms-1" href="{{ route('events.show',$event->id) }}">@lang('button.more_info')</a>
                                                @if ($event->registration and $event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                                    <a class="btn btn-success btn-sm disabled ms-1" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.opened')</a>
                                                @elseif ($event->registration == 1 and RegistrationController::countRegistrations($event->id) < $event->max_registrations)
                                                    <a class="btn btn-success btn-sm disabled ms-1" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.opened')</a>
                                                @else
                                                    <a class="btn btn-danger btn-sm disabled ms-1" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.closed')</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">All Members<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                <a class="dropdown-item" href="#">Locations</a>
                                <a class="dropdown-item" href="#">Revenue</a>
                                <a class="dropdown-item" href="#">Join Date</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Top Users</h4>

                    <div data-simplebar style="max-height: 336px;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-centered table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 20px;"><img
                                                src="{{ URL::asset('/assets/images/users/avatar-4.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Glenn Holden</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i>
                                                Nevada</p>
                                        </td>
                                        <td><span class="badge bg-soft-danger font-size-12">Cancel</span></td>
                                        <td class="text-muted fw-semibold text-end"><i
                                                class="icon-xs icon me-2 text-success"
                                                data-feather="trending-up"></i>$250.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-5.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Lolita Hamill</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i> Texas
                                            </p>
                                        </td>
                                        <td><span class="badge bg-soft-success font-size-12">Success</span></td>
                                        <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-danger"
                                                data-feather="trending-down"></i>$110.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-6.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Robert Mercer</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i>
                                                California</p>
                                        </td>
                                        <td><span class="badge bg-soft-info font-size-12">Active</span></td>
                                        <td class="text-muted fw-semibold text-end"><i
                                                class="icon-xs icon me-2 text-success"
                                                data-feather="trending-up"></i>$420.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-7.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Marie Kim</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i>
                                                Montana</p>
                                        </td>
                                        <td><span class="badge bg-soft-warning font-size-12">Pending</span></td>
                                        <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-danger"
                                                data-feather="trending-down"></i>$120.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-8.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Sonya Henshaw</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i>
                                                Colorado</p>
                                        </td>
                                        <td><span class="badge bg-soft-info font-size-12">Active</span></td>
                                        <td class="text-muted fw-semibold text-end"><i
                                                class="icon-xs icon me-2 text-success"
                                                data-feather="trending-up"></i>$112.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Marie Kim</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i>
                                                Australia</p>
                                        </td>
                                        <td><span class="badge bg-soft-success font-size-12">Success</span></td>
                                        <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-danger"
                                                data-feather="trending-down"></i>$120.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('/assets/images/users/avatar-1.jpg') }}"
                                                class="avatar-xs rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1 fw-normal">Sonya Henshaw</h6>
                                            <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i> India
                                            </p>
                                        </td>
                                        <td><span class="badge bg-soft-danger font-size-12">Cancel</span></td>
                                        <td class="text-muted fw-semibold text-end"><i
                                                class="icon-xs icon me-2 text-success"
                                                data-feather="trending-up"></i>$112.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div> <!-- data-sidebar-->
                </div><!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">Recent<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item" href="#">Recent</a>
                                <a class="dropdown-item" href="#">By Users</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Recent Activity</h4>

                    <ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 336px;">
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <p class="text-muted mb-1 font-size-13">Today<small class="d-inline-block ms-1">12:20
                                        pm</small></p>
                                <p class="mt-0 mb-0">Andrei Coman magna sed porta finibus, risus
                                    posted a new article: <span class="text-primary">Forget UX
                                        Rowland</span></p>
                            </div>
                        </li>
                        <li class="feed-item">
                            <p class="text-muted mb-1 font-size-13">22 Jul, 2020 <small class="d-inline-block ms-1">12:36
                                    pm</small></p>
                            <p class="mt-0 mb-0">Andrei Coman posted a new article: <span class="text-primary">Designer
                                    Alex</span></p>
                        </li>
                        <li class="feed-item">
                            <p class="text-muted mb-1 font-size-13">18 Jul, 2020 <small class="d-inline-block ms-1">07:56
                                    am</small></p>
                            <p class="mt-0 mb-0">Zack Wetass, sed porta finibus, risus Chris Wallace
                                Commented <span class="text-primary"> Developer Moreno</span></p>
                        </li>
                        <li class="feed-item">
                            <p class="text-muted mb-1 font-size-13">10 Jul, 2020 <small class="d-inline-block ms-1">08:42
                                    pm</small></p>
                            <p class="mt-0 mb-0">Zack Wetass, Chris combined Commented <span class="text-primary">UX
                                    Murphy</span></p>
                        </li>

                        <li class="feed-item">
                            <p class="text-muted mb-1 font-size-13">23 Jun, 2020 <small class="d-inline-block ms-1">12:22
                                    am</small></p>
                            <p class="mt-0 mb-0">Zack Wetass, sed porta finibus, risus Chris Wallace
                                Commented <span class="text-primary"> Developer Moreno</span></p>
                        </li>
                        <li class="feed-item pb-1">
                            <p class="text-muted mb-1 font-size-13">20 Jun, 2020 <small class="d-inline-block ms-1">09:48
                                    pm</small></p>
                            <p class="mt-0 mb-0">Zack Wetass, Chris combined Commented <span class="text-primary">UX
                                    Murphy</span></p>
                        </li>

                    </ol>

                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdownMenuButton4" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton4">
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title">Social Source</h4>

                    <div class="text-center">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary font-size-24">
                                <i class="mdi mdi-facebook text-primary"></i>
                            </span>
                        </div>
                        <p class="font-16 text-muted mb-2"></p>
                        <h5><a href="#" class="text-dark">Facebook - <span class="text-muted font-16">125 sales</span> </a>
                        </h5>
                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero
                            venenatis faucibus tincidunt.</p>
                        <a href="#" class="text-reset font-16">Learn more <i class="mdi mdi-chevron-right"></i></a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-primary font-size-16">
                                        <i class="mdi mdi-facebook text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Facebook</h5>
                                <p class="text-muted mb-0">125 sales</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-info font-size-16">
                                        <i class="mdi mdi-twitter text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Twitter</h5>
                                <p class="text-muted mb-0">112 sales</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-pink font-size-16">
                                        <i class="mdi mdi-instagram text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Instagram</h5>
                                <p class="text-muted mb-0">104 sales</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="#" class="text-primary font-size-14 fw-medium">View All Sources <i
                                class="mdi mdi-chevron-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
