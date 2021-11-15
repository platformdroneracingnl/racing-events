@component('mail::message', ['registration' => $registration, 'event' => $event, 'organization' => $organization])

Je inschrijving voor **{{ $event->name }}** op **{{ $event->date->format('d-m-Y') }}** is binnen! <br/><br/> @if ($event->mollie_payments == 1)
    Omdat je al reeds betaald hebt, is de status van je inschrijving: **{{ __($registration->first()->status->name) }}**. Je bent daardoor in ieder geval zeker van een plek!
@else
    De organisator zal zo spoedig mogelijk informatie sturen over de betaalwijze. Na de betaling van €**{{ number_format($event->first()->price, 2) }}** is je inschrijving compleet en ben je zeker van een plek.
@endif 

Voor verdere vragen kan je terecht bij de organisatie/persoon, door te reageren op deze email. Veel succes bij de wedstrijd!

@lang('email.regards'),<br>
{{ config('app.name') }}
@endcomponent

TODO Verder aanvullen en vertalen
{{-- {{ $registration }}
{{ $event }} --}}