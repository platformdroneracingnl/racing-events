@extends('layouts.backend.master')

@section('title')
    Roles - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Roles') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            @can('role-create')
                                <a href="{{ route('management.roles.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> {{ __('New Role') }}
                                </a>
                            @endcan
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body">
                    {{-- <h4 class="card-title">Default Datatable</h4> --}}
                    <p class="card-title-desc">Beheer hier de rollen die een gebruiker kan hebben op het platform
                    </p>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Nr.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <form action="{{ route('management.roles.destroy', $role->id) }}" method="POST" class="deleteRole">
                                            @csrf
                                            @method('DELETE')
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a type="button" class="btn px-2 text-secondary" href="{{ route('management.roles.show', $role->id) }}">
                                                        <i class="uil uil-info-circle font-size-18"></i>
                                                    </a>
                                                </li>
                                                @can('role-edit')
                                                    <li class="list-inline-item">
                                                        <a type="button" class="btn px-2 text-primary" href="{{ route('management.roles.edit', $role->id) }}">
                                                            <i class="uil uil-pen font-size-18"></i>
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('role-delete')
                                                    <li class="list-inline-item">
                                                        <button type="submit" class="btn px-2 text-danger">
                                                            <i class="uil uil-trash-alt font-size-18"></i>
                                                        </button>
                                                    </li>
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
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/role.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection
