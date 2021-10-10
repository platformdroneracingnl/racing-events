@extends('layouts.backend.master')

@section('title')
    Organizations - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Organizations @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Header -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            @can('organization-create')
                                <a href="{{ route('management.organizations.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> {{ __('New Organization') }}
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
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="row">
                @foreach ($organizations as $organization)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-role="organization">
                        <div class="card text-center" style="height: 17rem;">
                            <div class="card-body">
                                <div class="clearfix"></div>
                                <div class="mb-4">
                                    <a href="{{ route('management.organizations.show', $organization->id) }}">
                                        <img src="@if(!empty($organization->image)) {{ asset('storage') }}/images/organizations/{{$organization->image}} @else {{ asset('pdrnl') }}/img/ateam.png @endif" alt=""
                                            class="avatar-lg rounded-circle img-thumbnail">
                                    </a>
                                </div>
                                <div class="mb-1">
                                    <h5 class="font-size-18">
                                        <a href="{{ route('management.organizations.show', $organization->id) }}" class="text-dark">{{ $organization->name }}</a>
                                    </h5>
                                </div>
                                <div class="mb-1">
                                    <h5 class="font-size-16 text-muted">
                                        {{ $organization->short_name }}
                                    </h5>
                                </div>
                            </div>
                            <form action="{{ route('management.organizations.destroy', $organization->id) }}" method="post" class="deleteOrganization">
                                <div class="row">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        @can('organization-edit')
                                            <a type="button" href="{{ route('management.organizations.edit', $organization->id) }}" class="btn btn-outline-light text-truncate">
                                                <i class="uil uil-pen me-1"></i> @lang('button.edit')
                                            </a>
                                        @endcan
                                        @can('organization-delete')
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
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/organization.js"></script>
    <script src="{{ asset('pdrnl')}}/js/manager/organizations.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection