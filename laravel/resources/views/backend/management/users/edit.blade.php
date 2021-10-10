@extends('layouts.backend.master')

@section('title')
    Edit user - Management
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Users') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{ __('Change user') }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                <a href="{{ route('management.users.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body">
                    <form action="{{route('management.users.update',$user->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('patch')
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Naam *</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Naam" required value="{{$user->name}}">
                                </div>
                            </div>
                            {{-- Pilot name --}}
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="pilot_name">Piloot naam *</label>
                                    <input type="text" id="pilot_name" name="pilot_name" class="form-control" placeholder="Piloot naam" required value="{{$user->pilot_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- Email --}}
                            <div class="col-12 col-sm-8 col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="email">E-mail *</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" required value="{{$user->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- Organization --}}
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="organization">Organisatie</label>
                                    <select class="custom-select form-select" name="organization_id" id="organization">
                                        <option value="option_select" disabled selected>--- {{__('Kies een organisatie')}} ---</option>
                                        <option value="" {{$user->organization == null  ? 'selected' : ''}}>{{__('Geen organisatie')}}</option>
                                        @foreach ($organizations as $organization)
                                            <option value="{{$organization->id}}" {{$user->organization_id == $organization->id  ? 'selected' : ''}}>{{$organization->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Race Team --}}
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="race_team">Race Team</label>
                                    <select class="custom-select form-select" name="race_team_id" id="race_team">
                                        <option value="option_select" disabled selected>--- {{__('Kies een race team')}} ---</option>
                                        <option value="" {{$user->race_team == null  ? 'selected' : ''}}>{{__('Geen race team')}}</option>
                                        @foreach ($raceTeams as $team)
                                            <option value="{{$team->id}}" {{$user->race_team_id == $team->id  ? 'selected' : ''}}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- Password --}}
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="password">Wachtwoord:</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Wachtwoord">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="confirm-password">Bevestig Wachtwoord:</label>
                                    <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Bevestig Wachtwoord">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="roles">Rol</label>
                                    <select class="select2 form-select select2-multiple" multiple="multiple" id="roles" name="roles[]" data-placeholder="Choose ...">
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $role }}" {{ $user->getRoleNames()->contains($role) ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">@lang('button.adjust')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('pdrnl')}}/js/manager/user.js"></script>
@endsection