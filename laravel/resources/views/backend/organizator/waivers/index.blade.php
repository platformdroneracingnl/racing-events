@extends('layouts.backend.master')

@section('title')
    Waivers - Organizator
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Organizator @endslot
        @slot('title') {{ __('Waivers') }} @endslot
    @endcomponent

    @include('backend.snippets.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">@lang('category/events.waivers')</h3>
                        </div>

                        <!-- Search -->
                        <div class="col-12 col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input id="searchbox" type="text" class="form-control rounded bg-light border-0"
                                            placeholder="{{ __('Search') }}...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="row">
                        <p class="card-title-desc">In deze tabel vind je alle ingevulde afstandsverklaringen van piloten, die zich hebben aangemeld op een van jouw wedstrijden.</p>
                    </div>

                    <!-- Table -->
                    <div class="row">
                        <div class="table-responsive">
                            <table id="waiverTable" class="table align-middle table-hover nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">@lang('category/users.name')</th>
                                        <th scope="col">@lang('category/profile.pilot_name')</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">@lang('category/events.competition')</th>
                                        <th scope="col">@lang('category/events.signed_on')</th>
                                        <th scope="col">@lang('button.options')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $waiver)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ WaiverController::getUser($waiver->user_id)->name }}</td>
                                            <td>{{ WaiverController::getUser($waiver->user_id)->pilot_name }}</td>
                                            <td>{{ WaiverController::getUser($waiver->user_id)->email }}</td>
                                            <td>{{ WaiverController::getCompetition($waiver->event_id)->name }}</td>
                                            <td>{{ $waiver->created_at->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ route('organizator.waiver.export', $waiver->id) }}"><i class="far fa-file-pdf"></i> Export als PDF</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/sweetalerts/event.js"></script>
    <script src="{{ asset('pdrnl')}}/js/dataTables/waivers.js"></script>
    <script>
        var locale = {!! json_encode($lang) !!};
    </script>
@endsection