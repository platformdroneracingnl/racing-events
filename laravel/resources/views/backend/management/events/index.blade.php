@extends('layouts.backend.master')

@section('title')
    Events - Management
@endsection

@php
    use App\Http\Controllers\Pilots\RegistrationController;
@endphp

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Events') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            @can('event-create')
                                <a href="{{ route('management.events.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> @lang('button.new')
                                </a>
                            @endcan
                        </div>

                        <!-- Search -->
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input id="searchbox" type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="row">
                        <p class="card-title-desc">Beheer alle gebruikers die aangemeld zijn op het platform
                        </p>
                    </div>

                    <!-- Table -->
                    <div class="row">
                        <div class="table-responsive">
                            <table id="eventsTable" class="table align-middle table-hover nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">@lang('category/events.competition')</th>
                                        <th scope="col">@lang('category/events.organizer')</th>
                                        <th scope="col">@lang('category/events.date')</th>
                                        <th scope="col">@lang('category/events.start_registration')</th>
                                        <th scope="col">@lang('category/events.num_entries')</th>
                                        <th scope="col">@lang('category/events.visible') <i class="fas fa-info-circle" data-toggle="tooltip" title="{{ __('Whether the event is already visible to pilots') }}"></i></th>
                                        <th scope="col">@lang('category/events.registration') <i class="fas fa-info-circle" data-toggle="tooltip" title="{{ __('Whether the registration is open') }}"></i></th>
                                        <th scope="col">@lang('category/events.waitlist') <i class="fas fa-info-circle" data-toggle="tooltip" title="{{ __('Whether a waiting list is used') }}"></i></th>
                                        <th scope="col">@lang('button.options')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->organization->name }}</td>
                                            <td>{{ $event->date->format('d-m-Y') }}</td>
                                            <td>{{ $event->start_registration->format('d-m-Y') }}</td>
                                            <td>
                                                {{ RegistrationController::countRegistrations($event->id) }} / 
                                                {{ $event->max_registrations }}
                                            </td>
                                            <td>
                                                @if ($event->online == 1)
                                                    <span class="badge bg-success">{{ __('Online') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Offline') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($event->registration == 1)
                                                    <span class="badge bg-success">@lang('category/events.opened')</span>
                                                @else
                                                    <span class="badge bg-danger">@lang('category/events.closed')</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($event->waitlist == 1)
                                                    <span class="badge bg-success">@lang('category/events.in_use')</span>
                                                @else
                                                    <span class="badge bg-danger">@lang('category/events.not_use')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('management.events.destroy', $event->id) }}" method="POST" class="deleteEvent">
                                                    @csrf
                                                    @method('DELETE')
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a type="button" class="btn px-2 text-secondary" href="{{ route('management.events.show', $event->id) }}">
                                                                <i class="uil uil-info-circle font-size-18"></i>
                                                            </a>
                                                        </li>
                                                        @can('event-edit')
                                                            <li class="list-inline-item">
                                                                <a type="button" class="btn px-2 text-primary" href="{{ route('management.events.edit', $event->id) }}">
                                                                    <i class="uil uil-pen font-size-18"></i>
                                                                </a>
                                                            </li>
                                                        @endcan
                                                        @can('event-delete')
                                                            <li class="list-inline-item">
                                                                <button type="submit" class="btn px-2 text-danger">
                                                                    <i class="uil uil-trash-alt font-size-18"></i>
                                                                </button>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </form>
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
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/event.js"></script>
    <script src="{{ asset('pdrnl')}}/js/dataTables/events.management.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection