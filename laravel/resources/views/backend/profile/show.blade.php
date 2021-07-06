@extends('layouts.backend.master')

@section('title')
    @lang('translation.Profile')
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/litepicker/litepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') PDRNL @endslot
        @slot('title') Profile @endslot
    @endcomponent

    @if (empty(auth()->user()->country) or empty(auth()->user()->pilot_name))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @lang('category/profile.not_complete')
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ __('Profile is complete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <!-- Profile summary -->
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">
                            <a class="text-body dropdown-toggle font-size-18" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="uil uil-ellipsis-v"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <img src="{{ URL::asset('/assets/images/users/avatar-4.jpg') }}" alt=""
                                class="avatar-xl rounded-circle img-thumbnail">
                        </div>
                        <h4 class="mt-3 mb-1">{{ auth()->user()->name }} @if(!empty($countryCode->code)) / {{ $countryCode->code}} @endif </h4>
                        <p class="text-muted">{{ auth()->user()->pilot_name }}</p>

                        @if(!empty(auth()->user()->getRoleNames()))
                            <div class="mt-4">
                                <button type="button" class="btn btn-success btn-sm">
                                    @foreach(auth()->user()->getRoleNames() as $rol)
                                        {{ $rol }}
                                    @endforeach
                                </button>
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="text-muted">
                        <h5 class="font-size-16">About</h5>
                        <p>Hi I'm Marcus,has been the industry's standard dummy text To an English person, it will seem like
                            simplified English, as a skeptical Cambridge.</p>
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name :</p>
                                <h5 class="font-size-16">Marcus</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Mobile :</p>
                                <h5 class="font-size-16">012-234-5678</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">E-mail :</p>
                                <h5 class="font-size-16">marcus@minible.com</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Location :</p>
                                <h5 class="font-size-16">California, United States</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist" id="profile-list">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#overview" role="tab">
                            <i class="uil uil-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changeprofile" role="tab">
                            <i class="uil uil-clipboard-notes font-size-20"></i>
                            <span class="d-none d-sm-block">@lang('category/profile.change_prof')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#authentication" role="tab">
                            <i class="uil uil-shield-check font-size-20"></i>
                            <span class="d-none d-sm-block">@lang('category/profile.2fa_authentication')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changepassword" role="tab">
                            <i class="uil uil-key-skeleton-alt font-size-20"></i>
                            <span class="d-none d-sm-block">@lang('category/profile.change_pass')</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        @include('backend.profile.parts.profile_info')
                    </div>
                    <div class="tab-pane" id="changeprofile" role="tabpanel">
                        @include('backend.profile.parts.profile_change')
                    </div>
                    <div class="tab-pane" id="authentication" role="tabpanel">
                        @include('backend.profile.parts.profile_2fa_settings')
                    </div>
                    <div class="tab-pane" id="changepassword" role="tabpanel">
                        @include('backend.profile.parts.profile_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/litepicker/litepicker.min.js') }}"></script>
    <script src="{{ asset('pdrnl')}}/js/profile.js"></script>
@endsection