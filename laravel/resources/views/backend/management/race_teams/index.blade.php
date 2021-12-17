@extends('layouts.backend.master')

@section('title')
    Race teams - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Race teams') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Header -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            @can('race_team-create')
                                <a href="{{ route('management.race_teams.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> {{ __('New Race Team') }}
                                </a>
                            @endcan
                        </div>
                        <!-- Search -->
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control search rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="row">
                @foreach ($race_teams as $key => $raceTeam)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-role="team">
                        <div class="card text-center" style="height: 17rem;">
                            <div class="card-body">
                                <div class="clearfix"></div>
                                <div class="mb-4">
                                    <a href="{{ route('management.race_teams.show', $raceTeam->id) }}">
                                        <img src="@if(!empty($raceTeam->image)) {{ asset('storage') }}/images/race_teams/{{$raceTeam->image}} @else {{ asset('pdrnl') }}/img/ateam.png @endif" alt=""
                                            class="avatar-lg rounded-circle img-thumbnail">
                                    </a>
                                </div>
                                <div class="mb-1">
                                    <h5 class="font-size-18">
                                        <a href="{{ route('management.race_teams.show', $raceTeam->id) }}" class="text-dark">{{ $raceTeam->name }}</a>
                                    </h5>
                                </div>
                                <p class="text-muted mb-2">@if(!empty($raceTeam->description)) {{ substr($raceTeam->description, 0,  20)." ..." }} @endif</p>
                            </div>
                            <form action="{{ route('management.race_teams.destroy',$raceTeam->id) }}" method="post" class="deleteRaceTeam">
                                <div class="row">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        @can('race_team-edit')
                                            <a type="button" href="{{ route('management.race_teams.edit', $raceTeam->id) }}" class="btn btn-outline-light text-truncate">
                                                <i class="uil uil-pen me-1"></i> @lang('button.edit')
                                            </a>
                                        @endcan
                                        @can('race_team-delete')
                                            <button type="submit" class="btn btn-outline-light text-truncate">
                                                <div class="text-danger">
                                                    <i class="uil uil-trash-alt me-1"></i> @lang('button.delete')
                                                </div>
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/race_team.js"></script>
    <script src="{{ asset('pdrnl')}}/js/manager/race_teams.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection