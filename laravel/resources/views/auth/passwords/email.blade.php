@extends('layouts.auth.master-without-nav')

@section('title')
    @lang('pages/reset.title')
@endsection

@section('content')
    <div class="account-pages my-5  pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            @include('layouts.auth.logo')

                            <div class="text-center mt-2">
                                <h5 class="text-primary">@lang('pages/reset.title')</h5>
                                <p class="text-muted">@lang('pages/reset.email_info')</p>
                            </div>
                            <div class="p-2 mt-4">
                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email"
                                            placeholder="Enter email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light"
                                            type="submit">@lang('pages/reset.button')</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Remember It ? <a href="{{ url('login') }}"
                                                class="fw-medium text-primary"> Signin </a></p>
                                    </div>

                                    @include('layouts.auth.footer')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
