@extends('layouts.backend.master')

@section('title')
    Create role - Management
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
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{__('Create new role')}}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 text-end">
                                <a href="{{ route('management.roles.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('management.roles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">@lang('category/users.name')</label>
                                    <input type="text" name="name" id="name" placeholder="@lang('category/users.name')" class="form-control">
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
                                                <input class="form-check-input me-1" type="checkbox" name="permission[]" value="{{ $value->id }}">
                                                {{ $value->name }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection