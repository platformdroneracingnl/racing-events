@extends('frontend.layout.master')

@php
    use App\Http\Controllers\Organizator\RegistrationController;
    use Carbon\Carbon;
@endphp

@section('title')
    Events
@endsection

@section('header')
    <!-- hero section start -->
    <section class="section hero-section bg-ico-hero">
        <span class="mask bg-gradient-default bg-primary opacity-7"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="text-white-50">
                        <h1 class="text-light fw-semibold mb-3 hero-title">Event Registrations</h1>
                        <p class="font-size-14" style="color:white;">Nog nooit was het zo makkelijk om in te schrijven voor een drone wedstrijden en met een QR Code checkin op de wedstrijd dag.</p>

                        <div class="button-items mt-4">
                            <a href="#" class="btn btn-success">Maak account aan</a>
                            <a href="#" class="btn btn-light">Meer info</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-sm-10 ms-lg-auto">
                    {{-- <div class="card overflow-hidden mb-0 mt-5 mt-lg-0">
                        <div class="card-header text-center">
                            <h5 class="mb-0">ICO Countdown time</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">

                                <h5>Time left to Ico :</h5>
                                <div class="mt-4">
                                    <div data-countdown="2021/12/31" class="counter-number ico-countdown"></div>
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-success w-md">Get Token</button>
                                </div>

                                <div class="mt-5">
                                    <h4 class="font-weight-semibold">1 ETH = 2235 SKT</h4>
                                    <div class="clearfix mt-4">
                                        <h5 class="float-end font-size-14">5234.43</h5>
                                    </div>
                                    <div class="progress p-1 progress-xl softcap-progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 15%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-label">15 %</div>
                                        </div>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <div class="progress-label">30 %</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- hero section end -->
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h4>Wedstrijden</h4>
                    </div>
                </div>
            </div>

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
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
@endsection