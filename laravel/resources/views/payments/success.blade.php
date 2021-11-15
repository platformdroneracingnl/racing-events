@extends('layouts.backend.master')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center mb-4">
                            <div class="row">
                                <h2>Je aanmelding voor {{ $event->name }} is binnen!</h2>
                            </div>
                            <iframe src="https://giphy.com/embed/3ohzdIuqJoo8QdKlnW" style="border-radius: 10px;" width="480" height="222" frameBorder="0" class="giphy-embed gif-on-mobile mb-3" allowFullScreen></iframe>
                            <p>
                                Indien je nog vragen hebt over de wedstrijd, neem dan contact op met de organisator.<br> Dit kan door te reageren op de bevestigingsmail.
                            </p>
                            <p>
                                <b>Datum wedstrijd</b>: {{ $event->date->format('d-m-Y') }}<br>
                                <b>Status inschrijving</b>: {{ __($registration[0]->status->name) }}
                            </p>
                            <p>
                                Omdat je al direct betaald hebt via Mollie, ben je zeker van een plek en zijn er geen verdere acties nodig.<br>
                                Behalve dan het klaarmaken van je gear voor deze wedstrijd 😁 Veel succes!
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