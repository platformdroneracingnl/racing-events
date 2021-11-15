@extends('layouts.backend.master')

@php
    use App\Http\Controllers\Organizator\RegistrationController;
    use Carbon\Carbon;
@endphp

@section('title')
    Events
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Pilots @endslot
        @slot('title') {{ __('Events') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">@lang('menu.competitions')</h3>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-centered align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Nr.</th>
                                    <th scope="col">@lang('category/events.competition')</th>
                                    <th scope="col">@lang('category/events.organizer')</th>
                                    <th scope="col">@lang('category/events.date')</th>
                                    <th scope="col">Pilots <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Number of registrations / Maximum number') }}"></i></th>
                                    <th scope="col">@lang('category/events.start_registration')</th>
                                    <th scope="col">@lang('category/events.closed')</th>
                                    <th scope="col">@lang('category/events.price')</th>
                                    <th scope="col">@lang('button.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    {{ $loop->iteration }}
                                                </div>
                                                <!-- If today is in the week before the registration start date  -->
                                                <h5 style="vertical-align:middle;margin-top: 4px;">
                                                    @if ($event->start_registration->format('Y-m-d') >= Carbon::today()->subWeek()->toDateString())
                                                        <span class="badge bg-info">@lang('category/events.new')</span>
                                                    @endif
                                                </h5>
                                            </div>
                                        </th>
                                        <!-- Competition name -->
                                        <td>{{ $event->name }}</td>
                                        <!-- Organizator -->
                                        <td>
                                            @if (isset($event->organization_id))
                                                {{ $event->organization->name }}
                                            @else
                                                {{ $event->user->name }}
                                            @endif
                                        </td>
                                        <!-- Event datum -->
                                        <td>{{ $event->date->format('d-m-Y') }}</td>
                                        <!-- Number of registrations -->
                                        <td>
                                            {{ RegistrationController::countRegistrations($event->id) }} / {{ $event->max_registrations }}
                                            @if ($event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                                <span class="badge bg-success">{{ __('Waitlist') }}</span>
                                            @elseif (RegistrationController::countRegistrations($event->id) == $event->max_registrations)
                                                <span class="badge bg-warning">@lang('category/events.full')!</span>
                                            @endif
                                        </td>
                                        <!-- Start registratie datum -->
                                        <td>
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    {{ $event->start_registration->format('d-m-Y') }}
                                                </div>
                                                <h5 style="vertical-align:middle;margin-top: 4px;">
                                                    @if ($event->registration == 0 and $event->start_registration >= Carbon::today())
                                                        <!-- If registration is closed and start date -->
                                                        <span class="badge bg-soft-info">{{ __('Registration starts soon') }}</span>
                                                    @elseif ($event->registration == 1 and $event->end_registration >= Carbon::today())
                                                        <!-- If registration is open and today is before the end date -->
                                                        <span class="badge bg-soft-success">{{ __('Registration is open') }}!</span>
                                                    @endif
                                                </h5>
                                            </div>
                                        </td>
                                        <!-- Eind registratie datum -->
                                        <td>
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    {{ $event->end_registration->format('d-m-Y') }}
                                                </div>
                                                <h5 style="vertical-align:middle;margin-top: 4px;">
                                                    @if ($event->end_registration < Carbon::today())
                                                        <!-- If today is after the end date -->
                                                        <span class="badge bg-danger">{{ __('Registration date has passed') }}</span>
                                                    @elseif ($event->registration == 0)
                                                        <!-- If the registration is turned off or  -->
                                                        <span class="badge bg-danger">{{ __('Registration closed') }}</span>
                                                    @elseif ($event->registration == 1 and $event->end_registration >= Carbon::today())
                                                        <!-- If registration is open and today is before end date -->
                                                        <span class="badge bg-success">@lang('pdrnl.days_left', ['days' => Carbon::today()->diffInDays($event->end_registration)])</span>
                                                    @endif
                                                </h5>
                                            </div>
                                        </td>
                                        <!-- Price -->
                                        <td>
                                            @if ($event->price == 0)
                                                {{ __('Free') }}!
                                            @else
                                                €{{ number_format($event->price, 2) }}
                                            @endif
                                        </td>
                                        <!-- Action buttons -->
                                        <td>
                                            <!-- Show more info button -->
                                            <a class="btn btn-sm btn-primary ms-1" href="{{ route('events.show',$event->id) }}">@lang('button.more_info')</a>
                                            @if (RegistrationController::checkRegistration($event->id) == true)
                                                <!-- When you already has signup for the event -->
                                                <button class="btn btn-sm btn-outline-dark ms-1" disabled>@lang('button.signed_up')</button>
                                            @elseif ($event->registration and $event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                                <!-- If the waitlist option is on -->
                                                <button type="button" class="btn btn-sm btn-info ms-1" data-bs-toggle="modal" data-bs-target="#regModal-{{ $event->id }}">@lang('category/events.register')</button>
                                            @elseif ($event->registration == 1 and RegistrationController::countRegistrations($event->id) < $event->max_registrations)
                                                <!-- If registration is open and number of registration is below the max -->
                                                <button type="button" class="btn btn-sm btn-info ms-1" data-bs-toggle="modal" data-bs-target="#regModal-{{ $event->id }}">@lang('category/events.register')</button>
                                            @else
                                                <!-- Close registration -->
                                                <a class="btn btn-sm btn-danger disabled ms-1" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.closed')</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($events as $event)
                        <!-- waiver modal -->
                        @include('layouts.modals.waiver')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection