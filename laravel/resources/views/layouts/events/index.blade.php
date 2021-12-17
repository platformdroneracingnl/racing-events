@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') @yield('type') @endslot
        @slot('title') {{ __('Events') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            @can('event-create')
                                <a href="@yield('eventCreateButton')" class="btn btn-success waves-effect waves-light btn-on-mobile">
                                    <i class="mdi mdi-plus me-2"></i> @lang('button.new')
                                </a>
                            @endcan
                        </div>

                        <!-- Search -->
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input id="searchbox" type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('eventTableIndex')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/event.js"></script>
    <script src="{{ asset('pdrnl')}}/js/dataTables/management.events.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection