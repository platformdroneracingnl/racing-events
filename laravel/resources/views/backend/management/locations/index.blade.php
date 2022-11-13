@extends('layouts.backend.master')

@section('title')
    Locations - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Locations @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Header -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            @can('location-create')
                                <a href="{{ route('management.locations.create') }}" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> {{ __('New Location') }}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="row">
                @foreach ($locations as $location)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-role="location">
                        @if(!empty($location->image))
                            <div style="position: relative">
                                <img src="{{ asset('storage') }}/images/locations/{{$location->image}}" class="card-img-top" alt="location cover image" style="object-fit: cover; object-position: center; height: 12rem">
                                <h4 style="position: absolute; top: 10px; right: 15px;"><span class="badge bg-info">{{ $location->category }}</span></h4>
                            </div>
                        @else
                            <div style="position: relative">
                                <div style="height: 12rem;" class="text-center bg-dark card-img-top">
                                    <div style="top: 18%; position: relative;">
                                        <i class="fas fa-map-marked-alt fa-7x text-white"></i>
                                    </div>
                                </div>
                                <h4 style="position: absolute; top: 10px; right: 15px;"><span class="badge bg-info">{{ $location->category }}</span></h4>
                            </div>
                        @endif
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="clearfix"></div>
                                <div class="mb-2">
                                    <h5 class="font-size-20">
                                        <a href="{{ route('management.locations.show', $location->id) }}" class="text-dark">{{ $location->name }}</a>
                                    </h5>
                                </div>
                                <div class="mb-1">
                                    <h5 class="font-size-16 text-muted">
                                        {{ $location->city }} / {{ $location->street }}
                                    </h5>
                                </div>
                            </div>
                            <form action="{{ route('management.locations.destroy', $location->id) }}" method="post" class="deleteLocation">
                                <div class="row">
                                    <div class="btn-group" role="group">
                                        @csrf
                                        @method('DELETE')
                                        @can('location-update')
                                            <a type="button" href="{{ route('management.locations.edit', $location->id) }}" class="btn btn-outline-light text-truncate">
                                                <i class="uil uil-pen me-1"></i> @lang('button.edit')
                                            </a>
                                        @endcan
                                        @can('location-delete')
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
    <script src="{{ asset('pdrnl')}}/js/manager/locations/index.js"></script>
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/location.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection