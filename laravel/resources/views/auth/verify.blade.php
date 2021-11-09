@extends('layouts.auth.master-without-nav')

@section('title')
    @lang('pages/verify.titel')
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

                        <div class="card-body p-4">
                            @include('layouts.auth.logo')

                            <div class="text-center mt-2">
                                <h5 class="text-primary">@lang('pages/verify.titel')</h5>
                            </div>

                            <div class="p-2 mt-4">
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        @lang('pages/verify.new_verify_email')
                                    </div>
                                @endif

                                <p>@lang('pages/verify.info')</p>
                                @if (Route::has('verification.send'))
                                    <p>@lang('pages/verify.no_email'):</p>
                                    <div class="text-center">
                                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-outline-primary align-baseline">@lang('pages/verify.request_new_email')</button>
                                        </form>
                                    </div>
                                @endif
                                <br>
                                <p class="mt-3 mb-0 text-center"><small>Issues with the verification process or entered the wrong email?
                                    <br>Please sign up with <a href="/register-retry">another</a> email address.</small></p>
                            </div>
                            @include('layouts.auth.footer')
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
    </div>
@endsection
