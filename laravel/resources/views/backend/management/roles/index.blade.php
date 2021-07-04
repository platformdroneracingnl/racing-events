@extends('layouts.backend.master')

@section('title')
    Rollen
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Rollen @endslot
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
                                        <input type="text" class="form-control rounded bg-light border-0"
                                            placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <h4 class="card-title">Default Datatable</h4> --}}
                    <p class="card-title-desc">Beheer hier de rollen die een gebruiker kan hebben op het platform
                    </p>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-dark">
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
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('management.roles.show',$role->id) }}" class="px-2 text-secondary">
                                                            <i class="uil uil-info-circle font-size-18"></i>
                                                        </a>
                                                    </li>
                                                    @can('role-edit')
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('management.roles.edit',$role->id) }}" class="px-2 text-primary">
                                                                <i class="uil uil-pen font-size-18"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('role-delete')
                                                        <li class="list-inline-item">
                                                            <a class="px-2 text-danger" type="submit">
                                                                <i class="uil uil-trash-alt font-size-18"></i>
                                                            </a>
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
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
