@extends('layouts.backend.master')

@section('title')
    Edit location - Management
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{__('Locations')}} @endslot
    @endcomponent

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <form action="{{ route('management.locations.update', $location->id) }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <!-- Header -->
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4 id="name" class="mb-0">{{__('Edit location')}}</h4>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="text-end">
                                        <a href="{{ route('management.locations.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                            <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Het toevoegen van een locatie is vrij eenvoudig! Pin point de locatie op de kaart hieronder en de gegevens aan de rechterkant worden automatisch voor je ingevuld, mocht er iets ontbreken dan kan je dit zelf nog aanpassen/aanvullen.</p>
                        </div>
                    </div>
                    <!-- Map -->
                    <div class="card shadow">
                        <div id="map" style="width: 100%; height: 450px;"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="form_latitude">Latitude *</label>
                                        <input id="form_latitude" type="text" name="latitude" class="form-control" value="{{ $location->latitude }}" placeholder="{{__('Wordt automatisch ingevuld')}}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="form_longitude">Longitude *</label>
                                        <input id="form_longitude" type="text" name="longitude" class="form-control" value="{{ $location->longitude }}" placeholder="{{__('Wordt automatisch ingevuld')}}" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <!-- Header -->
                        <div class="card-header bg-dark border-0">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4 id="name" class="mb-0 text-white">{{__('Location details')}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Location image -->
                        <img id="img-upload" src="@if(!empty($location->image)) {{ asset('storage') }}/images/locations/{{$location->image}} @else {{ asset('pdrnl') }}/img/image-placeholder.jpg @endif" alt="Your location image" style="object-fit: cover; object-position: center; height: 300px;">
                        <!-- Body -->
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="mb-3">
                                    <p class="text-muted">
                                        {{ __('Upload an image of the location here. The preview only shows a part of the image, this is not the final view everywhere on the platform.') }}
                                    </p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-8">
                                        <div class="mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input form-control" id="customFile" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="mb-3">
                                        <label for="form_name">{{ __('Name') }} *</label>
                                        <input type="text" id="form_name" name="name" class="form-control" value="{{ $location->name }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="form_category">Categorie *</label>
                                        <select class="form-select" name="category" id="form_category" required>
                                            <option value="" disabled selected>--- {{__('Choose a category')}} ---</option>
                                            <option value="indoor" @selected($location->category == "indoor")>{{ __('Indoor') }}</option>
                                            <option value="outdoor" @selected($location->category == "outdoor")>{{ __('Outdoor') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="mb-3">
                                        <label for="form_street">{{ __('Street') }} *</label>
                                        <input id="form_street" type="text" name="street" class="form-control" value="{{ $location->street }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="form_house_number">Huisnummer</label>
                                        <input id="form_house_number" type="text" name="house_number" class="form-control" value="{{ $location->house_number }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="form_zip_code">Postcode *</label>
                                        <input id="form_zip_code" type="text" name="zip_code" class="form-control" value="{{ $location->zip_code }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="mb-3">
                                        <label for="form_city">Stad *</label>
                                        <input id="form_city" type="text" name="city" class="form-control" value="{{ $location->city }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="form_province">Provincie *</label>
                                        <input id="form_province" type="text" name="province" class="form-control" value="{{ $location->province }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="input-country">Land *</label>
                                        <select name="country_id" id="input-country" class="select2 form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                            <option value="" disabled selected>--- {{__('Kies een land')}} ---</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}" @selected($location->country_id == $country->id) >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="form_description">Opmerkingen</label>
                                        <textarea id="form_description" class="form-control" style="height:60px" name="comment" placeholder="Extra opmerkingen indien het adres onvoldoende is om de locatie te vinden">{{ $location->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted mb-4">{{ __('De velden met een ster (*) dienen minimaal te zijn ingevuld.') }}</p>
                            <input type="hidden" name="oldImage" value="{{$location->image}}">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">@lang('button.adjust')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('pdrnl')}}/js/manager/locations/edit.js"></script>
@endsection