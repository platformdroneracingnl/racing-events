@extends('layouts.backend.master')

@section('title')
    Show role
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Show role @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 text-end">
                                @can('user-edit')
                                    <a href="{{ route('management.roles.edit',$role->id) }}" class="me-1 btn btn-warning waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-pencil-outline me-2"></i> Change role
                                    </a>
                                @endcan
                                <a href="{{ route('management.roles.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>@lang('category/users.name'):</strong>
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <strong>{{ __('Permissions') }}:</strong><br>
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="label label-success">{{ $v->name }}</label><br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection