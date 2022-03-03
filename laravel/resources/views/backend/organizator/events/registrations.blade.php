@extends('layouts.backend.master')

@section('title')
    Registrations - Event
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
                                <a class="btn btn-info btn-on-mobile ms-1" href="{{ route('event.scan') }}"><i class="fas fa-qrcode"></i> Scan</a>
                                <button type="button" class="btn btn-info btn-on-mobile ms-1" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fas fa-info-circle"></i> @lang('button.information')</button>
                                <a class="btn btn-success btn-on-mobile ms-1" href="{{ route('organizator.event.export', $event->id) }}"><i class="far fa-file-pdf"></i> {{__('Export PDF')}}</a>
                                <a class="btn btn-secondary btn-on-mobile ms-1" href="{{ route('organizator.events.index') }}"><i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('event.registrations.update-all') }}" method="post">
                    @method('PATCH')
                    @csrf
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
                            <div class="table-responsive">
                                <table id="registrationsTable" class="table align-middle table-centered table-hover dt-responsive table-nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col"><input type="checkbox" value="selectAll" id="masterCheck"/></th>
                                            <th scope="col">Nr.</th>
                                            <th scope="col">@lang('category/profile.name')</th>
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
                                        @foreach ($registrations as $registration)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="registrations[]" value="{{ $registration->reg_id }}">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <!-- User -->
                                                <td>{{ $registration->user->name }}</td>
                                                <!-- Country -->
                                                <td> @if(!empty($registration->user->countries->name)) {{$registration->user->countries->name}} @endif </td>
                                                <!-- Pilot name -->
                                                <td>{{ $registration->user->pilot_name }}</td>
                                                <td>{{ $registration->user->race_team }}</td>
                                                <!-- Email -->
                                                <td>{{ $registration->user->email }}</td>
                                                <!-- Registration date -->
                                                <td>{{ $registration->created_at->format('d-m-Y H:i') }}</td>
                                                <!-- Status -->
                                                <td>
                                                    <h5 class="mb-0">
                                                        <!-- Registration status -->
                                                        @include('backend.snippets.registration-status')
                                                    </h5>
                                                </td>
                                                <!-- Check-in -->
                                                <td>
                                                    <h5 class="mb-0">
                                                        @if ($registration->vtx_power and $registration->failsafe == 1)
                                                            <span class="badge bg-soft-success">{{ __('Ready to fly!') }}</span>
                                                        @elseif(($registration->vtx_power == 0 or $registration->failsafe == 0) and $registration->status_id == 3)
                                                            <span class="badge bg-soft-warning">{{ __('Still have to check in') }}</span>
                                                        @else
                                                        @endif
                                                    </h5>
                                                </td>
                                                <!-- Options -->
                                                <td>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <button type="button" class="btn px-2 text-primary" data-bs-toggle="modal" data-bs-target="#regModal-{{$registration->reg_id}}" href="">
                                                                <i class="uil uil-pen font-size-18"></i>
                                                            </button>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <button type="button" class="btn px-2 text-danger" data-bs-toggle="modal" data-bs-target="#userModal-{{$registration->reg_id}}" href="">
                                                                <i class="uil uil-trash-alt font-size-18"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer py-3">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-9">
                                <input class="mt-3" type="checkbox" onclick="toggleAutoRefresh(this);" id="reloadCB"> {{ __('Auto refresh') }} <span style="display: none;" id="countdown-info">(nog <span id="countdown"></span> secondes)</span>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="input-group text-center">
                                    <select class="select2 form-select form-check-inline" name="status_id" data-style="btn-primary" id="status_id" required>
                                        <option value="" disabled selected class="text-center">--- {{__('Choose a status')}} ---</option>
                                        @foreach ($registrationStatus as $status)
                                            <option value="{{$status->id}}">{{ __($status->name) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-warning btn-on-mobile" type="submit">{{ __('Adjust selection') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($registrations as $registration)
        <!-- Change event registration for a user -->
        <div class="modal fade" id="regModal-{{$registration->reg_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('event.registration.update',$registration->reg_id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('patch')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Adjust registration') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ __('Adjust the status of a registration here and, if necessary, perform the check-in for this drone pilot.') }}</p>
                            <div class="mb-3">
                                <strong>{{ __('Registration status') }}:</strong><br>
                                <select class="form-select" name="status_id" id="status_id" required>
                                    @foreach ($registrationStatus as $status)
                                        <option value="{{$status->id}}" @selected($status->id == $registration->status_id)>{{ __($status->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                                <label for="inlineCheckbox1" data-on-label="{{ __('Approved') }}" data-off-label="{{ __('Disapproved') }}"></label>
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
                                                <label for="inlineCheckbox2" data-on-label="{{ __('Approved') }}" data-off-label="{{ __('Disapproved') }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete a user -->
        <div class="modal fade" id="userModal-{{$registration->reg_id}}" tabindex="-1" role="dialog" aria-labelledby="userRegistrationDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('organizator.registration.destroy',$registration->reg_id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="userRegistrationDelete">{{ __('Remove registration') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">@lang('category/events.delete_registration', ['name' => $registration->user->name])</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.cancel')</button>
                            <button type="submit" class="btn btn-danger">@lang('button.delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Information Modal -->
    @include('layouts.modals.status')
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('pdrnl')}}/js/auto-refresh.js"></script>
    <script src="{{ asset('pdrnl')}}/js/dataTables/organizator.registrations.js"></script>
    <script type="text/javascript">
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection