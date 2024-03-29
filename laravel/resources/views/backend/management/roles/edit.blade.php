@extends('layouts.backend.master')

@section('title')
    Edit role - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Roles') }} @endslot
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
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{ __('Change role') }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                <a href="{{ route('management.roles.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('management.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">@lang('category/users.name')</label>
                                    <input type="text" name="name" id="name" placeholder="@lang('category/users.name')" class="form-control" value="{{ $role->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Permissions') }}</label>
                                    <div class="list-group">
                                        @foreach ($permission as $value)
                                            <label class="list-group-item">
                                                <input class="form-check-input me-1" @checked(in_array($value->id, $rolePermissions)) type="checkbox" name="permission[]" value="{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        @endforeach
                                    </div>
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