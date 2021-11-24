@extends('layouts.backend.master')

@section('title')
    My registrations
@endsection

@php
    use App\Http\Controllers\Utils\MollieController;
    use Carbon\Carbon;
@endphp

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Event @endslot
        @slot('title') {{ __('Registrations') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">{{ __('My registrations') }}</h3>
                        </div>
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
                        <p class="card-title-desc">In deze tabel vind je alle wedstrijden waar je je voor hebt aangemeld. Op de wedstrijddag laat je de QR Code zien aan de organisator voor de check-in.</p>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-centered align-middle table-nowrap" id="registrationTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nr.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Check-in <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="{{ __('Has the pilot already had his QR code scanned during the competition?') }}"></i></th>
                                    <th scope="col">@lang('category/events.competition')</th>
                                    <th scope="col">@lang('category/events.date')</th>
                                    <th scope="col">@lang('category/events.registered_on')</th>
                                    <th scope="col">Betaling</th>
                                    <th scope="col">QR Code</th>
                                    <th scope="col">@lang('button.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registrations->registrations as $registration)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <h5 class="mb-0">
                                                <!-- Registration status -->
                                                @include('backend.snippets.registration-status')
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 class="mb-0">
                                                @if ($registration->vtx_power and $registration->failsafe == 1)
                                                    <span class="badge bg-soft-success">Ready to fly!</span>
                                                @elseif (($registration->vtx_power == 0 or $registration->failsafe == 0) and $registration->status_id == 3)
                                                    <span class="badge bg-soft-warning">{{ __('Still have to check in') }}</span>
                                                @else
                                                @endif
                                            </h5>
                                        </td>
                                        <!-- Event name -->
                                        <td>{{ $registration->event->name }}</td>
                                        <!-- Event date -->
                                        <td>{{ $registration->event->date->format('d-m-Y') }}</td>
                                        <!-- Registration date -->
                                        <td>{{ $registration->created_at->format('d-m-Y H:i') }}</td>
                                        <!-- Payment -->
                                        <td>
                                            @if ($registration->status_id == 2 and $registration->payment_id != null)
                                                <div class="text-center">
                                                    <a class="btn btn-sm btn-info" href="{{ route('payment.event', ['paymentID' => $registration->payment_id]) }}">{{ __('Pay registration') }}</a>
                                                    <br><span class="text-muted">Verloopt {{ MollieController::checkPaymentExpire($registration->payment_id) }}!</span>
                                                </div>
                                            @elseif ($registration->status_id == 3 and $registration->event->price > 0)
                                                <h5 class="mb-0"><span class="badge bg-soft-success">{{ __('You paid') }}</span></h5>
                                            @elseif ($registration->status_id == 3 and $registration->event->price == 0)
                                                <h5 class="mb-0"><span class="badge bg-soft-primary">{{ __('Competition is free') }}</span></h5>
                                            @endif
                                        </td>
                                        <!-- QR Code -->
                                        <td>
                                            @if ($registration->event->date >= Carbon::today()->toDateString() and $registration->status_id == 3)
                                                <a class="btn btn-secondary qr-code" data-bs-toggle="modal" data-bs-target="#Modal-{{$registration->reg_id}}" href=""><i class="fas fa-qrcode"></i></a>
                                            @elseif ($registration->status_id == 2)
                                                <!-- Waiting for payment -->
                                                <h5 class="mb-0"><span class="badge bg-soft-warning">{{ __('Only visible after payment') }}</span></h5>
                                            @else
                                                <h5 class="mb-0"><span class="badge bg-soft-danger">{{ __('No longer valid') }}</span></h5>
                                            @endif
                                        </td>
                                        <!-- Show event page -->
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('events.show',$registration->event_id) }}">@lang('category/events.competition_info')</a>
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
    @foreach ($registrations->registrations as $registration)
        <!-- Modal -->
        <div class="modal fade" id="Modal-{{$registration->reg_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkinModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="checkinModalLabel">{{ __('Check-in') }}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="visible-print text-center">
                            <div class="row mb-3">
                                <h4>{{ $registration->event->name }}</h4>
                            </div>
                            <div class="row mb-3">
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            {{ QrCode::size(350)->style('round')->generate(route('event.check-in',[$registration->reg_id])) }}
                                            <div class="text-muted">Use for mobile scanning</div>
                                        </div>
                                        <div class="carousel-item">
                                            {{ QrCode::size(350)->style('round')->generate($registration->reg_id) }}
                                            <div class="text-muted">{{ $registration->reg_id }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                @if ($registration->failsafe == 1 and $registration->vtx_power == 1 and $registration->status_id == 3)
                                    <h4><span class="badge bg-info">{{ __('QR code has been scanned - good luck with the competition!') }}</span></h4>
                                @else
                                    <h4><span class="badge bg-warning">{{ __('QR code has yet to be scanned') }}</span></h4>
                                @endif
                            </div>
                            <p class="text-muted">@lang('category/events.qr_code_text')</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/dataTables/pilot.registrations.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection