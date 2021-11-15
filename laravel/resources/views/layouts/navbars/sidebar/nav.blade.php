<!-- ========== Left Sidebar menu Start ========== -->
<div class="vertical-menu">

    <!-- Brand logo -->
    @include('layouts.navbars.snippets.logo')

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('dashboard')}}">
                        <i class="uil-home-alt"></i>
                        <span>@lang('menu.dashboard')</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('events')}}">
                        <i class="uil-calendar-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>@lang('menu.competitions')</span>
                    </a>
                </li>

                <li>
                    <a href="https://rankings.platformdroneracing.nl/" target="_blank">
                        <i class="fas fa-chart-line"></i>
                        <span>@lang('menu.results')</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('news') }}">
                        <i class="uil-newspaper"></i>
                        <span>@lang('menu.news')</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="my-1">
                <!-- Heading -->
                <li class="menu-title">Drone Pilot</li>

                <li>
                    <a href="{{ route('registrations.index') }}" class="waves-effect">
                        <i class="uil-sign-in-alt"></i>
                        <span class="badge rounded-pill bg-warning float-end">New</span>
                        <span>@lang('menu.my_registrations')</span>
                    </a>
                </li>

                @if(auth()->user()->hasRole(['organizer','manager','supervisor']))
                    <!-- Divider -->
                    <hr class="my-1">
                    <!-- Heading -->
                    <li class="menu-title">Organisator</li>

                    <li>
                        <a href="{{ route('organizator.events.index') }}" class="waves-effect">
                            <i class="uil-calendar-alt"></i>
                            <span>@lang('menu.my_competitions')</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('organizator.waivers.index') }}" class="waves-effect">
                            <i class="uil-comments-alt"></i>
                            <span>@lang('category/events.waivers')</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasRole(['manager','supervisor']))
                    <!-- Divider -->
                    <hr class="my-1">
                    <!-- Heading -->
                    <li class="menu-title">PDRNL Supervisor</li>

                    @if (auth()->user()->hasRole(['manager','supervisor']))
                        @can('event-list')
                            <li>
                                <a class="nav-link" href="{{ route('management.events.index') }}">
                                    <i class="uil-list-ul"></i>
                                    <span>@lang('menu.manage_competitions')</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                    @can('location-list')
                        <li>
                            <a class="nav-link" href="{{ route('management.locations.index') }}">
                                <i class="uil-list-ul"></i>
                                <span>@lang('menu.manage_locations')</span>
                            </a>
                        </li>
                    @endcan
                    @can('organization-list')
                        <li>
                            <a class="nav-link" href="{{ route('management.organizations.index') }}">
                                <i class="uil-list-ul"></i>
                                <span>@lang('menu.manage_organizations')</span>
                            </a>
                        </li>
                    @endcan
                    @can('race_team-list')
                        <li>
                            <a class="nav-link" href="{{ route('management.race_teams.index') }}">
                                <i class="uil-list-ul"></i>
                                <span>@lang('menu.manage_race_teams')</span>
                            </a>
                        </li>
                    @endcan
                    @can('user-list')
                        <li>
                            <a class="nav-link" href="{{ route('management.users.index') }}">
                                <i class="uil-list-ul"></i>
                                <span>@lang('menu.manage_users')</span>
                            </a>
                        </li>
                    @endcan
                    @can('role-list')
                        <li>
                            <a class="nav-link" href="{{ route('management.roles.index') }}">
                                <i class="uil-list-ul"></i>
                                <span>@lang('menu.manage_roles')</span>
                            </a>
                        </li>
                    @endcan
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->