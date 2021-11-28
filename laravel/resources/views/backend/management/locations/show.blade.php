@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Locations') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text-end">
                                @can('location-edit')
                                    
                                @endcan
                                <a href="{{ route('management.locations.index') }}" class="btn btn-secondary waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection