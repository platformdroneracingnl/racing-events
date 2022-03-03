@extends('layouts.backend.master')

@section('title')
    Edit event - Management
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Events @endslot
    @endcomponent

    <form action="{{route('management.events.update', $event->id)}}" method="POST" enctype="multipart/form-data" role="form">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <h4 id="name" class="mb-0">{{ __('Edit') }} - {{ $event->name }}</h4>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="text-end">
                                    <a href="{{ route('management.events.index') }}" class="ms-1 btn btn-secondary waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-arrow-left ms-1"></i> @lang('button.back')
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-on-mobile ms-1">@lang('button.adjust')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Supervisor settings -->
            <div class="col-12 col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        @include('layouts.events.event_text')
                        <hr>
                        <div class="row mb-3">
                            <h4>{{ __('Supervisor instellingen') }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="user">Gebruiker *</label>
                                    <select class="select2 form-select" id="user" name="user_id" required>
                                        <option value="" disabled selected>--- {{__('Kies een gebruiker')}} ---</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" @selected($event->user_id == $user->id)>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="organization">Organisator *</label>
                                    <select class="select2 form-select" id="organization" name="organization_id" required>
                                        <option value="" disabled selected>--- {{__('Kies een organisator')}} ---</option>
                                        @foreach ($organizations as $organization)
                                            <option value="{{$organization->id}}" @selected($event->organization_id == $organization->id)>{{$organization->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">@lang('button.adjust')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                @include('layouts.events.edit_form')
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/inputmask/inputmask.min.js') }}"></script>
    <script src="{{ asset('pdrnl')}}/js/organizer/event.js"></script>
@endsection