<div>
    <h5 class="font-size-16 mb-3">@lang('category/profile.2fa_authentication') (2FA)</h5>
</div>

<div class="">
    <p>@lang('category/profile.2fa_verify_message')</p>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Generate 2FA key -->
    @if($data['user']->loginSecurity == null)
        <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
            @csrf
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-on-mobile">
                    @lang('button.generate_2fa_key')
                </button>
            </div>
        </form>

    <!-- 2FA Setup -->
    @elseif(!$data['user']->loginSecurity->google2fa_enable)
        <!-- Step one -->
        1. @lang('category/profile.2fa_step_one') <br>
        <div class="row justify-content-center" style="margin: 20px 0px 20px 0px;">
            <div class="col-6 col-md-3 text-center">
                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="__blank">
                    <i class="fab fa-google-play" style="font-size: xxx-large"></i><br>
                    <p>Google Play store</p>
                </a>
            </div>
            <div class="col-6 col-md-3 text-center">
                <a href="https://apps.apple.com/nl/app/google-authenticator/id388497605" target="__blank">
                    <i class="fab fa-apple" style="font-size: xxx-large"></i><br>
                    <p>Apple Store</p>
                </a>
            </div>
        </div>
        
        <!-- Step two -->
        2. @lang('category/profile.2fa_step_two'): <code>{{ $data['secret'] }}</code><br/>
        <div class="row">
            <div class="d-flex justify-content-center">
                <img src="{{ $data['google2fa_url'] }}" alt="QRCode">
            </div>
        </div>

        <!-- Step three -->
        3. @lang('category/profile.enter_code'):<br/><br/>
        <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
            @csrf
            <div class="col-12 col-md-6 col-lg-4">
                <div class="mb-3 {{ $errors->has('verify-code') ? ' has-error' : '' }}">
                    <input id="secret" type="password" placeholder="@lang('category/profile.security_code')" class="form-control col-md-4" name="secret" required>
                    @if ($errors->has('verify-code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('verify-code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                @lang('button.enable_2fa')
            </button>
        </form>

    <!-- If 2FA is enabled -->
    @elseif($data['user']->loginSecurity->google2fa_enable)
        <div class="alert alert-success">
            @lang('category/profile.2fa_status')
        </div>
        <p>@lang('category/profile.2fa_how_to_disable')</p>
        <div class="col-12 col-md-6 col-lg-4">
            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                {{ csrf_field() }}
                <div class="input-group{{ $errors->has('current-password') ? ' has-error' : '' }}" id="show_hide_password">
                    <input id="current-password" type="password" placeholder="{{ __('Current Password') }}" class="form-control col-md-4" name="current-password" required>
                    <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                    @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary ">@lang('button.disable_2fa')</button>
            </form>
        </div>
    @endif
</div>