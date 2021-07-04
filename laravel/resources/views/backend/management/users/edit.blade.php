@extends('layouts.backend.master')

@section('title')
    Edit user
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Edit user @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            @can('role-create')
                                <div class="mb-3">
                                    <a href="{{ route('management.roles.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-plus me-2"></i> Add New
                                    </a>
                                </div>
                            @endcan
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end mb-3">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input id="searchbox" type="text" class="form-control rounded bg-light border-0"
                                            placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <form action="{{route('management.users.update',$user->id)}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            @method('patch')
                            <div class="row">
                                {{-- Name --}}
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Naam: *</strong>
                                        <input type="text" name="name" class="form-control" placeholder="Naam" required value="{{$user->name}}">
                                    </div>
                                </div>
                                {{-- Pilot name --}}
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Piloot naam: *</strong>
                                        <input type="text" name="pilot_name" class="form-control" placeholder="Piloot naam" required value="{{$user->pilot_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Email --}}
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="mb-3">
                                        <strong>E-mail: *</strong>
                                        <input type="text" name="email" class="form-control" placeholder="E-mail" required value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Organization --}}
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Organisatie:</strong>
                                        <select class="custom-select form-control" name="organization">
                                            <option value="option_select" disabled selected>--- {{__('Kies een organisatie')}} ---</option>
                                            <option value="" {{$user->organization == null  ? 'selected' : ''}}>{{__('Geen organisatie')}}</option>
                                            @foreach ($organizations as $organization)
                                                <option value="{{$organization->id}}" {{$user->organization == $organization->id  ? 'selected' : ''}}>{{$organization->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Race Team --}}
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Race Team:</strong>
                                        <select class="custom-select form-control" name="raceteam">
                                            <option value="option_select" disabled selected>--- {{__('Kies een race team')}} ---</option>
                                            <option value="" {{$user->raceteam == null  ? 'selected' : ''}}>{{__('Geen race team')}}</option>
                                            @foreach ($raceTeams as $team)
                                                <option value="{{$team->id}}" {{$user->raceteam == $team->id  ? 'selected' : ''}}>{{$team->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Password --}}
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Wachtwoord:</strong>
                                        <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <strong>Bevestig Wachtwoord:</strong>
                                        <input type="password" name="confirm-password" class="form-control" placeholder="Bevestig Wachtwoord">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="mb-3">
                                        <strong>Rol:</strong>
                                        <select class="form-select" multiple name="roles[]">
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role }}" {{ $user->getRoleNames()->contains($role) ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection