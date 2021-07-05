@extends('layouts.auth.master-without-nav')

@section('content')
    <div class="account-pages my-5  pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            @include('layouts.auth.logo')

                            <div class="text-center mt-2">
                                <h5 class="text-primary">@lang('category/profile.2fa_verify_title')</h5>
                                <p class="text-muted">@lang('category/profile.enter_code')</p>
                            </div>

                            <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                                @csrf
                                <div class="mb-3 {{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                    <input id="one_time_password" placeholder="@lang('category/profile.security_code')" name="one_time_password" class="form-control col-md-4"  type="text" required/>
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">
                                        @lang('button.authenticate')
                                    </button>
                                </div>
                            </form>

                            @include('layouts.auth.footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection