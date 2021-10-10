@extends('layouts.backend.master')

@section('title')
    Events - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Events') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 class="mb-0">{{ $event->name }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                @can('event-edit')
                                    <a href="{{ route('management.events.edit',$event->id) }}" class="me-1 btn btn-warning waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-pencil-outline me-2"></i> Change event
                                    </a>
                                @endcan
                                <a href="{{ route('management.events.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>Datum:</strong>
                                {{ $event->date->format('d-m-Y') }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>Inschrijving geopend vanaf:</strong>
                                {{ $event->start_registration->format('d-m-Y') }}<br>
                                <strong>Inschrijving gesloten op:</strong>
                                {{ $event->end_registration->format('d-m-Y') }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>Max. aantal deelnemers:</strong>
                                {{ $event->max_registrations }}<br>
                                <strong>Organisator:</strong>
                                @if(!empty($event->organization_id)) {{ $event->organization->name }} @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>Beschrijving:</strong><br>
                                {!! $event->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection