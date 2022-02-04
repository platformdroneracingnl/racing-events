@extends('layouts.frontend.master')

@section('title')
    Home
@endsection

@section('content')
    <div class="row mb-3 mt-3">
        <div class="text-center mt-7 mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('pdrnl') }}/img/brand/pdrnl-black.png" alt="Company logo" style="width: 80%; margin-bottom: 20px;">
                    <h2>@lang('pdrnl.welcome')</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/user.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                <div class="card-body">
                    <h4 class="card-title text-center">{{ __('Easy registration for competitions') }}</h4>
                    <p class="card-text text-center">{{ __('Create an account and register for competitions, registering has never been easier.') }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/list.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                <div class="card-body">
                    <h4 class="card-title text-center">{{ __('Clear management for organizers') }}</h4>
                    <p class="card-text text-center"> {{ __('As the organizer of a competition you have all registrations in a row and you decide when a registration is opened.') }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top mx-auto d-block" src="{{ asset('pdrnl') }}/img/svg/check.svg" alt="Card image cap" style="width: 50%; padding-top:24px;">
                <div class="card-body">
                    <h4 class="card-title text-center">{{ __('Digital check-in') }}</h4>
                    <p class="card-text text-center">{{ __('No more paper registration lists! Checking in is done via a QR code, which you have scanned by the organizer.') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection