@extends('layouts.events.index')

@section('eventCreateButton')
    {{ route('management.events.create') }}
@endsection

@section('type')
    {{ __('Management') }}
@endsection

@section('title')
    Events - Management
@endsection

@php
    use App\Http\Controllers\Pilots\RegistrationController;
@endphp

@section('eventTableIndex')
    <!-- Body -->
    <div class="row">
        <p class="card-title-desc">Beheer alle aangemaakte wedstrijden op dit platform.
        </p>
    </div>

    <!-- Table -->
    <div class="table-responsive mb-4">
        <table id="eventsTable" class="table table-centered table-nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">@lang('category/events.competition')</th>
                    <th scope="col">@lang('category/events.organizer')</th>
                    <th scope="col">@lang('category/events.date')</th>
                    <th scope="col">@lang('category/events.start_registration')</th>
                    <th scope="col">@lang('category/events.num_entries')</th>
                    <th scope="col">@lang('category/events.visible') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether the event is already visible to pilots') }}"></i></th>
                    <th scope="col">@lang('category/events.registration') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether the registration is open') }}"></i></th>
                    <th scope="col">@lang('category/events.waitlist') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether a waiting list is used') }}"></i></th>
                    <th scope="col">@lang('button.options')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <!-- Event name -->
                        <td>{{ $event->name }}</td>
                        <!-- Organizer or person -->
                        <td>
                            @if (isset($event->organization_id))
                                {{ $event->organization->name }}
                            @else
                                {{ $event->user->name }}
                            @endif
                        </td>
                        <td>{{ $event->date->format('d-m-Y') }}</td>
                        <td>{{ $event->start_registration->format('d-m-Y') }}</td>
                        <!-- Number of registrations -->
                        <td>
                            {{ RegistrationController::countRegistrations($event->id) }} / 
                            {{ $event->max_registrations }}
                        </td>
                        <!-- Visible -->
                        <td>
                            @if ($event->online == 1)
                                <span class="badge bg-success">{{ __('Online') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Offline') }}</span>
                            @endif
                        </td>
                        <!-- Registration -->
                        <td>
                            @if ($event->registration == 1)
                                <span class="badge bg-success">@lang('category/events.opened')</span>
                            @else
                                <span class="badge bg-danger">@lang('category/events.closed')</span>
                            @endif
                        </td>
                        <!-- Waitlist -->
                        <td>
                            @if ($event->waitlist == 1)
                                <span class="badge bg-success">@lang('category/events.in_use')</span>
                            @else
                                <span class="badge bg-danger">@lang('category/events.not_use')</span>
                            @endif
                        </td>
                        <!-- Options -->
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
                                    @can('event-update')
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
@endsection