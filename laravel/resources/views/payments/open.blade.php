@extends('layouts.backend.master')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center mb-4">
                            <div class="row">
                                <h2>Je aanmelding voor {{ $event->name }} staat nog open!</h2>
                            </div>
                            <iframe src="https://giphy.com/embed/322FqzFGuB8UN72BJs" style="border-radius: 10px;" width="480" height="222" frameBorder="0" class="giphy-embed gif-on-mobile mb-3" allowFullScreen></iframe>
                            <p>
                                <b>Datum wedstrijd</b>: {{ $event->date->format('d-m-Y') }}<br>
                                <b>Status inschrijving</b>: {{ __($registration[0]->status->name) }}
                            </p>
                            <h4>
                                Wil je alsnog mee doen met de wedstrijd en zeker zijn van een plekje?
                            </h4>
                            <p>
                                Klik dan op de betaalknop in je inschrijvingen overzicht, deze verloopt echter wel <strong>{{ $expireAt }}</strong>.<br>(daarna wordt je aanmelding verwijderd)
                            </p>
                            <!-- go to registrations -->
                            <a class="btn btn-primary" href="{{ route('registrations.index') }}">{{ __('Bekijk mijn inschrijvingen') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection