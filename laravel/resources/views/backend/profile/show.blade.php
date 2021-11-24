@extends('layouts.backend.master')

@section('title')
    @lang('translation.Profile')
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
        <div class="col-xl-4 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">
                            <a class="text-body dropdown-toggle font-size-18" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="uil uil-ellipsis-v"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changeAvatarModel">Change profile picture</a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteAccountModel">Remove account</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Avatar -->
                        <div type="button" data-bs-toggle="modal" data-bs-target="#changeAvatarModel">
                            <img src="@if(!empty(auth()->user()->image)) {{ asset('storage') }}/images/profiles/{{auth()->user()->image}} @else {{ asset('pdrnl') }}/img/default.png @endif" alt="Your profile image" class="avatar-xxl rounded-circle img-thumbnail">
                        </div>
                        <!-- User info -->
                        <h4 class="mt-3 mb-1">{{ auth()->user()->name }} @if(!empty(auth()->user()->countries)) / {{ auth()->user()->countries->code}} @endif </h4>
                        <p class="text-muted">{{ auth()->user()->pilot_name }}</p>

                        @if(!empty(auth()->user()->getRoleNames()))
                            <div class="mt-4">
                                <button type="button" class="btn btn-soft-success btn-sm">
                                    @foreach(auth()->user()->getRoleNames() as $rol)
                                        {{ $rol }}
                                    @endforeach
                                </button>
                            </div>
                        @endif

                        @unlessrole('supervisor')
                            <div class="text-center">
                                <button type="button" class="btn btn-outline-danger mt-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModel">{{ __('Delete my account') }}</button>
                            </div>
                        @endunlessrole
                    </div>

                    <hr class="my-4">

                    <div class="text-muted">
                        <h5 class="font-size-16">About</h5>
                        <p>Hi I'm Marcus,has been the industry's standard dummy text To an English person, it will seem like
                            simplified English, as a skeptical Cambridge.</p>
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name :</p>
                                <h5 class="font-size-16">{{ auth()->user()->name }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Mobile :</p>
                                <h5 class="font-size-16">{{ auth()->user()->phone }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">E-mail :</p>
                                <h5 class="font-size-16">{{ auth()->user()->email }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Country :</p>
                                <h5 class="font-size-16">{{ auth()->user()->countries->name }}</h5>
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

    <!-- Modal -->
    @include('layouts.modals.delete-account')

    <div class="modal fade" id="changeAvatarModel" tabindex="-1" aria-labelledby="changeAvatarModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAvatarModelLabel">Verander profielfoto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.avatar') }}" id="profileAvatar" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Avatar -->
                        <div class="text-center mb-3">
                            <img id="img-upload" src="@if(!empty(auth()->user()->image)) {{ asset('storage') }}/images/profiles/{{auth()->user()->image}} @else {{ asset('pdrnl') }}/img/default.png @endif" alt="Your profile image"
                                    class="avatar-xxxl rounded-circle img-thumbnail">
                        </div>
                        <p class="body-desc">
                            It will be easier for your friends to recognize you if you upload your real photo. You can upload the image in JPG, PNG or SVG format.
                        </p>

                        <div class="mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control form-control-alternative" id="customFile" name="image">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="oldImage" value="{{auth()->user()->image}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('button.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ asset('pdrnl')}}/js/profile.js"></script>
@endsection