@extends('layouts.backend.master')

@section('title')
    Event - Organizator
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{ __('Organizator') }} @endslot
        @slot('title') {{ __('Event') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $pending_reg }}</span></h4>
                            <p class="text-muted mb-0">{{ __('Number of entries') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $complete_reg }}</span></h4>
                            <p class="text-muted mb-0">{{ __('Registration completed') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">100</span></h4>
                            <p class="text-muted mb-0">Wachtlijst</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span>€{{ number_format($price_subtotal, 2) }},- / €{{ number_format($price_total, 2) }},-</span></h4>
                            <p class="text-muted mb-0">{{ __('Revenues') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0" id="name">{{ $event->name }}</h3>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                <a class="btn btn-info btn-on-mobile ms-1" href="{{ route('event.scan') }}"><i class="fas fa-qrcode"></i> Scan</a>
                                <a class="btn btn-info btn-on-mobile ms-1" href="{{ route('organizator.event.registrations',$event->id) }}"><i class="uil uil-users-alt me-1"></i> @lang('button.attendees')</a>
                                @can('event-edit')
                                    <a class="btn btn-warning btn-on-mobile ms-1" href="{{ route('organizator.events.edit', $event->id) }}"><i class="uil uil-pen me-1"></i> @lang('button.edit')</a>
                                @endcan
                                <a class="btn btn-secondary btn-on-mobile ms-1" href="{{ route('organizator.events.index') }}"><i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-nowrap mb-3">
                            <tbody>
                                <tr>
                                    <th class="text-nowrap" scope="row">Max. aantal deelnemers</th>
                                    <td>{{ $event->max_registrations }}</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">@lang('category/events.organizer')</th>
                                    <td>@if(!empty($event->organization_id)) {{ OrganizationController::getOrganization($event->organization_id)->name }} @else Onbekend @endif</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">@lang('category/events.price')</th>
                                    <td>
                                        @if ($event->price == 0)
                                            {{ __('Free') }}!
                                        @else
                                            €{{ number_format($event->price, 2) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">{{ __('Extra information') }}</th>
                                    <td>
                                        @if ($event->docs_link != null)
                                            <a href="{{ $event->docs_link }}" target="_blank">{{ __('Click here') }}</a>
                                        @else
                                            {{ __('Not available') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Google Calendar</th>
                                    <td>
                                        @if ($event->google_calendar_id != null)
                                            {{ __('Event is online in the agenda') }}
                                        @else
                                            {{ __('Not on the agenda') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="mb-5 mt-3">
                                <h5>@lang('pdrnl.information')</h5>
                                {!! $event->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="mb-3">
                                <strong>{{ __('Competition visible') }}</strong><br>
                                @if ($event->online)
                                    <h3><span class="badge bg-success"><i class="uil uil-check me-1"></i> @lang('button.is_on')</span></h3>
                                @else
                                    <h3><span class="badge bg-danger"><i class="uil uil-times me-1"></i>@lang('button.is_off')</span></h3>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="mb-3">
                                <strong>{{ __('Registration open') }}</strong><br>
                                @if ($event->registration)
                                    <h3><span class="badge bg-success"><i class="uil uil-check me-1"></i> @lang('button.is_on')</span></h3>
                                @else
                                    <h3><span class="badge bg-danger"><i class="uil uil-times me-1"></i>@lang('button.is_off')</span></h3>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="mb-3">
                                <strong>{{ __('Waiting list allowed') }}</strong><br>
                                @if ($event->waitlist)
                                    <h3><span class="badge bg-success"><i class="uil uil-check me-1"></i> @lang('button.is_on')</span></h3>
                                @else
                                    <h3><span class="badge bg-danger"><i class="uil uil-times me-1"></i>@lang('button.is_off')</span></h3>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="mb-3">
                                <strong>{{ __('Payments via Mollie') }}</strong><br>
                                @if ($event->mollie_payments)
                                    <h3><span class="badge bg-success"><i class="uil uil-check me-1"></i> @lang('button.is_on')</span></h3>
                                @else
                                    <h3><span class="badge bg-danger"><i class="uil uil-times me-1"></i>@lang('button.is_off')</span></h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow">
                @include('backend.snippets.google-maps', ['latitude' => $event->location->latitude, 'longitude' => $event->location->longitude])
                <div class="card-footer">
                    <!-- Adress -->
                    <strong><label for="eventAddress" class="form-label">{{ __('Navigation address') }}</label></strong><br>
                    {{ $event->location->street }} {{ $event->location->house_number }}, {{ $event->location->zip_code }} {{ $event->location->city }}
                </div>
            </div>
        </div>
    </div>
@endsection