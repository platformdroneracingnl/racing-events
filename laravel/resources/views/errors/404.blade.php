@extends('layouts.auth.master-without-nav')

@section('title')
    @lang('translation.Error_404')
@endsection

@section('content')
    <div class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <div class="">
                            <div class="row justify-content-center">
                                <div class="col-sm-4">
                                    <div class="error-img">
                                        <img src="{{ URL::asset('/assets/images/404-error.png') }}" alt=""
                                            class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-uppercase mt-4" style="color: white">404 - We got a fly away!</h4>
                            <p style="color: white">The page you are looking for might have been removed,<br>had its name changed or is temporarily unavailable.</p>
                            <div class="mt-5">
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard') }}">Return to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
