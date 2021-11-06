@extends('layouts.events.index')

@section('eventCreateButton')
    {{ route('organizator.events.create') }}
@endsection

@section('type')
    {{ __('Organizator') }}
@endsection

@section('title')
    Events - Organizator
@endsection

@php
    use App\Http\Controllers\Pilots\RegistrationController;
@endphp

@section('eventTableIndex')
    <!-- Body -->
    <div class="row">
        <p class="card-title-desc">Beheer hier alle wedstrijden die door jou zijn aangemaakt.
        </p>
    </div>

    <!-- Table -->
    <div class="table-responsive mb-4">
        <table id="eventsTable" class="table table-centered table-nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">@lang('category/events.competition')</th>
                    <th scope="col">@lang('category/events.date')</th>
                    <th scope="col">@lang('category/events.start_registration')</th>
                    <th scope="col">@lang('category/events.num_entries') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Number of registrations / Maximum number') }}"></i></th>
                    <th scope="col">@lang('category/events.visible') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether the event is already visible to pilots') }}"></i></th>
                    <th scope="col">@lang('category/events.registration') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether the registration is open') }}"></i></th>
                    <th scope="col">@lang('category/events.waitlist') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Whether a waiting list is used') }}"></i></th>
                    <th scope="col">@lang('category/events.payments') <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Or the payments go through Mollie or keep their own administration') }}"></i></th>
                    <th scope="col">@lang('button.options')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events->events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date->format('d-m-Y') }}</td>
                        <td>{{ $event->start_registration->format('d-m-Y') }}</td>
                        <td>
                            {{ RegistrationController::countRegistrations($event->id) }} / 
                            {{ $event->max_registrations }}
                        </td>
                        <!-- Online -->
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
                        <!-- Waitlist -->
                        <td>
                            @if ($event->waitlist == 1)
                                <span class="badge bg-success">@lang('category/events.in_use')</span>
                            @else
                                <span class="badge bg-danger">@lang('category/events.not_use')</span>
                            @endif
                        </td>
                        <!-- Mollie Payments -->
                        <td>
                            @if ($event->mollie_payments == 1)
                                <span class="badge bg-success">@lang('category/events.mollie_payments')</span>
                            @else
                                <span class="badge bg-info">@lang('category/events.own_administration')</span>
                            @endif
                        </td>
                        <td>
                            <form action="">
                                @csrf
                                @method('DELETE')
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a type="button" class="btn px-2 text-secondary" href="{{ route('organizator.events.show', $event->id) }}">
                                            <i class="uil uil-info-circle font-size-18"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a type="button" class="btn px-2 text-info" href="{{ route('organizator.event.registrations',$event->id) }}">
                                            <i class="uil uil-users-alt font-size-18"></i>
                                        </a>
                                    </li>
                                    @can('event-edit')
                                        <li class="list-inline-item">
                                            <a type="button" class="btn px-2 text-primary" href="{{ route('organizator.events.edit', $event->id) }}">
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