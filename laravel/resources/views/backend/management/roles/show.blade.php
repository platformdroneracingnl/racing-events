@extends('layouts.backend.master')

@section('title')
    Show role - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Roles') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{ $role->name }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                @can('role-update')
                                    <a href="{{ route('management.roles.edit',$role->id) }}" class="me-1 btn btn-warning waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-pencil-outline me-2"></i> @lang('button.edit') {{ __('role') }}
                                    </a>
                                @endcan
                                <a href="{{ route('management.roles.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="permissions">{{ __('Permissions') }}</label>
                                @if(!empty($rolePermissions))
                                    <ol class="list-group list-group-flush list-group-numbered">
                                        @foreach($rolePermissions as $v)
                                            <li class="list-group-item">{{ $v->name }}</li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection