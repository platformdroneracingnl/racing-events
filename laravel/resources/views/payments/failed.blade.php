@extends('layouts.backend.master')

@section('title')
    {{ __('Payment failed') }}
@endsection

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div class="card shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center mb-4">
                            <div class="row">
                                <h2>Je aanmelding is mislukt / geannuleerd 😢</h2>
                            </div>
                            <iframe src="https://giphy.com/embed/3oxRmGNqKwCzJ0AwPC" style="border-radius: 10px;" width="480" height="336" frameBorder="0" class="giphy-embed gif-on-mobile mb-3" allowFullScreen></iframe>
                            <p>
                                Uit de administratie blijkt dat de betaling niet gelukt is of geannuleerd, hierdoor is jouw registratie niet opgeslagen.<br> Wil je alsnog mee doen aan de wedstijd, meld je dan opnieuw aan.
                            </p>
                            <a class="btn btn-primary" href="{{ route('events') }}">{{ __('Naar wedstrijd overzicht') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection