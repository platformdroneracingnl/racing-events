<h5 class="font-size-16 mb-3">@lang('category/profile.change_pass')</h5>

<!-- Form -->
<form method="post" action="{{ route('profile.password.update') }}" autocomplete="off">
    @csrf
    @method('put')

    @if (session('password_status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('password_status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="pl-lg-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3 {{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                    <input type="password" name="old_password" id="input-current-password" class="form-control {{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                    
                    @if ($errors->has('old_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3 {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                    <input type="password" name="password" id="input-password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                    
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">@lang('category/profile.change_pass')</button>
        </div>
    </div>
</form>