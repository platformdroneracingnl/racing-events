@extends('layouts.backend.master')

@section('title')
    Users - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Users') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            @can('role-create')
                                <a href="{{ route('management.users.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> {{ __('New User') }}
                                </a>
                            @endcan
                        </div>
                        <!-- Search -->
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input id="searchbox" type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="row">
                        <p class="card-title-desc">Beheer alle gebruikers die aangemeld zijn op het platform
                        </p>
                    </div>

                    <!-- Table -->
                    <div class="row">
                        <div class="table-responsive">
                            <table id="usersTable" class="table align-middle table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Organization</th>
                                        <th scope="col">Race team</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Member since</th>
                                        <th scope="col">Suspended until</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <!-- Name -->
                                            <td>{{ $user->name }} @if ($user->suspended_until != null)
                                                    <span class="badge bg-danger">{{ __('Suspended') }}</span>
                                                @endif
                                            </td>
                                            <!-- Email -->
                                            <td>{{ $user->email }}</td>
                                            <!-- Organization -->
                                            <td> @if(!empty($user->organization)) {{ $user->organization->name }} @endif </td>
                                            <!-- Race team -->
                                            <td> @if(!empty($user->race_team)) {{ $user->race_team->name }} @endif</td>
                                            <!-- Roles -->
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                        <label class="badge bg-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <!-- Date account created -->
                                            <td>
                                                {{ $user->created_at->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                @if ($user->suspended_until != null)
                                                    {{ $user->suspended_until->format('d-m-Y') }}
                                                    <span class="badge bg-danger">@lang('pdrnl.days_left', ['days' => now()->diffInDays($user->suspended_until)])</span>
                                                @endif
                                            </td>
                                            <!-- Options -->
                                            <td>
                                                <form action="{{ route('management.users.destroy', $user->id) }}" method="POST" class="deleteUser">
                                                    @csrf
                                                    @method('DELETE')
                                                    <ul class="list-inline mb-0">
                                                        <!-- Show -->
                                                        <li class="list-inline-item">
                                                            <a type="button" class="btn px-2 text-secondary" href="{{ route('management.users.show',$user->id) }}">
                                                                <i class="uil uil-info-circle font-size-18"></i>
                                                            </a>
                                                        </li>
                                                        <!-- Edit -->
                                                        @can('user-edit')
                                                            <li class="list-inline-item">
                                                                <a type="button" class="btn px-2 text-primary" href="{{ route('management.users.edit',$user->id) }}">
                                                                    <i class="uil uil-pen font-size-18"></i>
                                                                </a>
                                                            </li>
                                                        @endcan
                                                        <!-- Suspend -->
                                                        @if ($user->id != auth()->user()->id)
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#banModal-{{$user->id}}">
                                                                @if ($user->suspended_until == null)
                                                                    {{ __('Blokkeer') }}
                                                                @else
                                                                    {{ __('Deblokkeer') }}
                                                                @endif
                                                            </button>
                                                        @endif
                                                        <!-- Delete -->
                                                        @can('user-delete')
                                                            @if ($user->id != auth()->user()->id)
                                                                <li class="list-inline-item">
                                                                    <button type="submit" class="btn px-2 text-danger">
                                                                        <i class="uil uil-trash-alt font-size-18"></i>
                                                                    </button>
                                                                </li>
                                                            @endif
                                                        @endcan
                                                    </ul>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    @foreach ($data as $key => $user)
        <!-- Block modal -->
        <div class="modal fade" id="banModal-{{$user->id}}" tabindex="-1" aria-labelledby="suspendModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('management.suspend_user', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="suspendModalLabel">{{ $user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p>Bepaal middels de datum hoelang je de toegang wil ontzeggen. De gebruiker krijgt hier melding van wanneer het probeerd in te loggen en bij minder dan <b>14 dagen</b>, wordt het aantal resterende dagen getoond.</p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <strong>Datum:</strong>
                                        <input type="date" class="form-control" name="suspended_until">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p>Deblokkeer een gebruiker door <b>geen datum</b> in te voeren.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/dataTables/users-management.js"></script>
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/user.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection