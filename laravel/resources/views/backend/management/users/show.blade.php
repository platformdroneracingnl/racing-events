@extends('layouts.backend.master')

@section('title')
    Show user - Management
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
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <h4 id="name">{{ $user->name }}</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 text-end">
                                @can('user-edit')
                                    <a href="{{ route('management.users.edit',$user->id) }}" class="me-1 btn btn-warning waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-pencil-outline me-2"></i> Change user
                                    </a>
                                @endcan
                                <a href="{{ route('management.users.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge bg-success">{{ $v }}</label>
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