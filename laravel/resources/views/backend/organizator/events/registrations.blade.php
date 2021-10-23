@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Event @endslot
        @slot('title') {{ __('Registrations') }} @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{ __('Participants of') }} {{ $event->name }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                <button type="button" class="btn btn-info btn-on-mobile" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fas fa-info-circle"></i> @lang('button.information')</button>
                                <a class="btn btn-secondary btn-on-mobile" href="{{ route('organizator.event.export', $event->id) }}"><i class="far fa-file-pdf"></i> {{__('Export PDF')}}</a>
                                <a class="btn btn-success btn-on-mobile" href="{{ route('organizator.events.index') }}">@lang('button.back')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-9">
                            <p style="margin-top: 10px;">Vind hier alle registraties voor de wedstrijd, wil je meer informatie klik dan op de <b>Informatie</b> button.</p>
                        </div>
                        <div class="col-sm-12 col-md-3 text-right">
                            <input type="text" id="searchbox" class="form-control" placeholder="Zoeken" autofocus>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <form action="{{ route('event.registrations.update-all') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="table-responsive">
                                <table class="table align-middle table-hover" id="registrationsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col"><input type="checkbox" value="selectAll" id="masterCheck"/></th>
                                            <th scope="col">Nr.</th>
                                            <th scope="col">@lang('category/users.name')</th>
                                            <th scope="col">@lang('category/profile.country')</th>
                                            <th scope="col">@lang('category/profile.pilot_name')</th>
                                            <th scope="col">Race team</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">{{ __('Registered on') }}</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Check-in <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Has the pilot already had his QR code scanned during the competition?') }}"></i></th>
                                            <th scope="col">@lang('button.options')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="check">
                                        @foreach ($registrations as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="registrations[]" value="{{ $item->reg_id }}">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <!-- User -->
                                                <td>{{ $item->user->first()->name }}</td>
                                                <!-- Pilot name -->
                                                <td>{{ $item->user->first()->pilot_name }}</td>
                                                <td>{{ $item->user->first()->race_team }}</td>
                                                <!-- Email -->
                                                <td>{{ $item->user->first()->email }}</td>
                                                <!-- Registration date -->
                                                <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Footer -->
                <div class="card-footer py-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">

                        </div>
                        <div class="col-12 col-sm-6 col-md-6 text-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($registrations as $item)
        
    @endforeach
    <!-- Information Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Information about registrations') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Explanation of the different statuses in the registration') }}:
                        <ul>
                            <li><b>{{ __('Waiting for payment') }}</b>: {{ __('registration has been received and is awaiting payment') }}</li>
                            <li><b>{{ __('Registration complete') }}</b>: {{ __('payment has been received, registration for the competition has been completed') }}</li>
                            <li><b>{{ __('Waitlist') }}</b>: {{ __('race is full and pilot is on a waiting list (if waiting list option is enabled)') }}</li>
                            <li><b>{{ __('Canceled') }}</b>: {{ __('registration has been canceled, but the pilot will not be refunded the registration fee') }}</li>
                            <li><b>{{ __('Refunded') }}</b>: {{ __('registration has been canceled and the organizer has refunded the registration fee') }}</li>
                        </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection