<h5 class="font-size-16 mb-3">@lang('category/profile.change_prof')</h5>

<!-- Form -->
<form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="pl-lg-4">
        <div class="row">
            <div class="col-12 col-md-6">
                {{-- Name --}}
                <div class="mb-3 {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">@lang('category/profile.name') *</label>
                    <input type="text" name="name" id="input-name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('category/users.name')" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                {{-- Pilot name --}}
                <div class="mb-3 {{ $errors->has('pilot_name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-pilot-name">@lang('category/profile.pilot_name') *</label>
                    <input type="text" name="pilot_name" id="input-pilot-name" class="form-control {{ $errors->has('pilot_name') ? ' is-invalid' : '' }}" placeholder="@lang('category/profile.pilot_name')" value="{{ old('pilot_name', auth()->user()->pilot_name) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                {{-- Date of Birth --}}
                <label class="form-control-label" for="input-date-of-birth">@lang('category/profile.date_of_birth')</label>
                <div class="input-group mb-3 {{ $errors->has('date_of_birth') ? ' has-danger' : '' }}">
                    <input type="text" name="date_of_birth" id="input-date-of-birth" class="form-control {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" placeholder="@lang('category/profile.date_of_birth')" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}">
                    <span class="input-group-text" for="input-date-of-birth"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                {{-- Country --}}
                <div class="mb-3 {{ $errors->has('country_id') ? ' has-danger' : '' }}">
                    <label class="form-select-label" for="input-country">@lang('category/profile.country') *</label>
                    <select name="country_id" id="input-country" class="form-select {{ $errors->has('country_id') ? ' is-invalid' : '' }}">
                        <option value="option_select" disabled selected>--- {{__('Choose a country')}} ---</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" @selected(auth()->user()->country_id == $country->id)>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                {{-- Email --}}
                <div class="mb-3 {{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-email">{{ __('E-mail') }} *</label>
                    <input type="email" name="email" id="input-email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email', auth()->user()->email) }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                {{-- Phone number --}}
                <div class="mb-3 {{ $errors->has('phonenumber') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-phonenumber">@lang('category/profile.phone')</label>
                    <input type="tel" name="phonenumber" id="input-phonenumber" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="@lang('category/profile.phone')" value="{{ old('phonenumber', auth()->user()->phonenumber) }}">
                </div>
            </div>
        </div>

        {{-- Profile picture --}}
        {{-- <div class="mb-3 ">
            <label class="form-control-label" for="customFile">@lang('category/profile.photo')</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input form-control" id="customFile" name="image">
                <label class="custom-file-label" for="customFile">@lang('category/profile.upload_photo')</label>
            </div>
            <div action="#" class="dropzone">
                <div class="fallback">
                    <input name="image" type="file">
                </div>
                <div class="dz-message needsclick">
                    <div class="mb-3">
                        <i class="display-4 text-muted uil uil-cloud-upload"></i>
                    </div>
                    <h4>Drop files here or click to upload.</h4>
                </div>
            </div>
        </div> --}}

        <input type="hidden" name="oldImage" value="{{auth()->user()->image}}">

        <p class="text-muted mb-4">{{ __('The fields with a star (*) must be completed at least.') }}</p>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">@lang('button.save')</button>
        </div>
    </div>
</form>
