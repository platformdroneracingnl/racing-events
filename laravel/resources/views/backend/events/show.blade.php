@extends('layouts.backend.master')

@php
    use App\Http\Controllers\Organizator\RegistrationController;
@endphp

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">{{$event->name}}</h3>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            @if (RegistrationController::checkRegistration($event->id) == true)
                                <!-- When you already has signup for the event -->
                                <button class="btn btn-outline-dark btn-on-mobile ms-1" disabled>@lang('button.signed_up')</button>
                            @elseif ($event->registration and $event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                <!-- If the waitlist option is on -->
                                <button type="button" class="btn btn-info ms-1" data-bs-toggle="modal" data-bs-target="#regModal-{{ $event->id }}">@lang('category/events.register')</button>
                            @elseif ($event->registration == 1 and RegistrationController::countRegistrations($event->id) < $event->max_registrations)
                                <!-- If registration is open and number of registration is below the max -->
                                <button type="button" class="btn btn-info ms-1" data-bs-toggle="modal" data-bs-target="#regModal-{{ $event->id }}">@lang('category/events.register')</button>
                            @else
                                <!-- Close registration -->
                                <a class="btn btn-danger btn-on-mobile ms-1 disabled" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.closed')</a>
                            @endif
                            <a class="btn btn-secondary btn-on-mobile ms-1" href="{{ url()->previous() }}"><i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <img src="@if(!empty($event->image)) {{ asset('storage') }}/images/events/{{$event->image}} @else {{ asset('pdrnl') }}/img/image-placeholder.jpg @endif" class="card-img-top" alt="Event illustration image">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="pdrnl-card-profile-stats d-flex {{ $agent->isMobile() ? 'flex-column' : 'flex-row' }} justify-content-center">
                                <div>
                                    <span class="heading">{{ $event->date->format('d-m-Y') }}</span>
                                    <span class="description">{{ __('Match date') }}</span>
                                </div>
                                <div>
                                    <span class="heading">{{ $event->start_registration->format('d-m-Y') }}</span>
                                    <span class="description">{{ __('Registration opens on') }}</span>
                                </div>
                                <div>
                                    <span class="heading">{{ $event->end_registration->format('d-m-Y') }}</span>
                                    <span class="description">{{ __('Registration closes') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- organizer -->
                        <div class="col-12 col-sm-12 col-md-12">
                            <h2 class="text-uppercase text-muted">@lang('category/events.general')</h2>
                            <strong>@lang('category/events.organizer'):</strong>
                            {{ $finalOrganizator }}
                        </div>
                        <!-- Price -->
                        <div class="col-12 col-sm-12 col-md-12">
                            <strong>@lang('category/events.price'):</strong>
                            @if ($event->price == 0)
                                {{ __('Free') }}!
                            @else
                                €{{ number_format($event->price, 2) }}
                            @endif
                            @if ($event->mollie_payments == 1)
                                ({{ __('you pay immediately after registration via Mollie') }})
                            @elseif ($event->mollie_payments == 0 and $event->price > 0)
                                ({{ __('after registration, the organizer sends additional information about the payment') }})
                            @else
                            @endif
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 mb-5">
                            <div class="">
                                <strong>{{ __('Extra information') }}:</strong>
                                @if ($event->docs_link != null)
                                    <a href="{{ $event->docs_link }}" target="_blank">{{ __('Click here') }}</a>
                                @else
                                    {{ __('Not available') }}
                                @endif
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-12 col-sm-12 col-md-12 mb-5">
                            <div class="form-group">
                                <h2 class="text-uppercase text-muted">@lang('category/events.description')</h2>
                                {!! $event->description !!}
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
                    <b><label for="eventAddress" class="form-label">{{ __('Navigation address') }}</label></b><br>
                    {{ $event->location->street }} {{ $event->location->house_number }}, {{ $event->location->zip_code }} {{ $event->location->city }}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.modals.waiver')
@endsection