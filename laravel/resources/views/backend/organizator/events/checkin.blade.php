@extends('layouts.backend.master')

@section('title')
    Check-in
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Event @endslot
        @slot('title') {{ __('Check-in') }} @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-12 col-md-7">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <h5 class="mb-0">{{ $registration->event->name }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="text-center mt-4">
                            <div class="clearfix"></div>
                            <!-- Avatar -->
                            <img src="@if(!empty($registration->user->image)) {{ asset('storage') }}/images/profiles/{{$registration->user->image}} @else {{ asset('pdrnl') }}/img/default.png @endif" alt="Your profile image" class="avatar-xxxl rounded-circle img-thumbnail">
                            <!-- User info -->
                            <h4 class="mt-3 mb-1">
                                {{ $registration->user->name }} @if(!empty($registration->user->country_id)) / {{ $registration->user->countries->code }} @endif
                            </h4>
                            <p class="text-muted">{{ $registration->user->pilot_name }}</p>
                            <div class="h3 mt-4">
                                @if(!empty($organization->name)) {{ $organization->name}} @endif
                            </div>
                            <div>
                                {{ $registration->user->race_team }}
                            </div>
                        </div>
                        <div class="row">
                            <p class="text-muted">
                                <strong>Lid sinds:</strong> {{ date('d-m-Y', strtotime($registration->user->created_at)) }} <br>
                                <strong>Telefoonnummer:</strong> {{ $registration->user->phonenumber }} <br>
                                <strong>E-mail:</strong> {{ $registration->user->email }} <br>
                                <strong>Aangemeld op:</strong> {{ $registration->created_at->format('d-m-Y H:i') }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('event.check-in.update',$registration->reg_id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="text-center">
                                <h4>Checks</h4>
                                <p class="text-muted">Tijdens de check-in zal er op de volgende punten worden gecontroleerd:</p>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="text-center">
                                        <h5>{{ __('Failsafe') }}</h5>
                                        <div class="square-switch-xxl">
                                            <input type="checkbox" id="inlineCheckbox1" name="failsafe" switch="bool" @checked($registration->failsafe == 1) />
                                            <label for="inlineCheckbox1" data-on-label="{{ __('Approved') }}" data-off-label="{{ __('Rejected') }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="text-center">
                                        <h5>{{ __('VTX vermogen') }}</h5>
                                        <div class="square-switch-xxl">
                                            <input type="checkbox" id="inlineCheckbox2" name="vtx_power" switch="bool" @checked($registration->vtx_power == 1) />
                                            <label for="inlineCheckbox2" data-on-label="{{ __('Approved') }}" data-off-label="{{ __('Rejected') }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.save')</button>
                                <a href="{{ route("event.scan") }}" class="btn btn-info btn-on-mobile">Opnieuw scannen</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection