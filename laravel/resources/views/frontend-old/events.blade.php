@extends('layouts.frontend.master')

@php
    use App\Http\Controllers\Organizator\RegistrationController;
    use Carbon\Carbon;
@endphp

@section('title')
    Events
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') PDRNL @endslot
        @slot('title') {{ __('Events') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($events as $event)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="@if(!empty($event->image)) {{ asset('storage') }}/images/events/{{$event->image}} @else {{ asset('pdrnl') }}/img/ateam.png @endif" alt=""
                                    class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">{!! Str::limit($event->description, 100) !!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        @if ($event->registration and $event->waitlist == 1 and RegistrationController::countRegistrations($event->id) >= $event->max_registrations)
                                            <a class="btn btn-sm btn-success disabled" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.opened')</a>
                                        @elseif ($event->registration == 1 and RegistrationController::countRegistrations($event->id) < $event->max_registrations)
                                            <a class="btn btn-sm btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.opened')</a>
                                        @else
                                            <a class="btn btn-sm btn-danger btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">@lang('category/events.closed')</a>
                                        @endif
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('events.show', $event->id) }}">@lang('button.more_info')</a>
                                    </div>
                                    <small class="text-muted">{{ $event->date->format('d-m-Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection