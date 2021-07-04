@extends('layouts.auth.master-without-nav')

@section('title')
    Verify Your Email Address
@endsection

@section('content')
    {{-- <div class="home-btn d-none d-sm-block">
        <a href="{{ url('index') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
    </div> --}}
    <div class="account-pages my-5  pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card">
                        @include('layouts.auth.logo')

                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>

                        @include('layouts.auth.footer')
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
    </div>
@endsection
