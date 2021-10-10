@extends('layouts.backend.master')

@section('title')
    Edit organization - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') Organizations @endslot
    @endcomponent

    <form action="{{ route('management.organizations.update', $organization->id) }}" method="POST" enctype="multipart/form-data" role="form" class="mb-3">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <h4 id="name" class="mb-0">{{ __('Change organization') }}</h4>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="text-end">
                                    <a href="{{ route('management.organizations.index') }}" class="me-1 btn btn-secondary waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.adjust')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body -->
        <div class="row">
            <div class="col-xl-4 mb-md-0">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="clearfix"></div>
                        <!-- Organization image -->
                        <div class="mb-3">
                            <img id="img-upload" src="@if(!empty($organization->image)) {{ asset('storage') }}/images/organizations/{{$organization->image}} @else {{ asset('pdrnl') }}/img/ateam.png @endif" alt="Your organization image"
                                    class="avatar-xxxl rounded-circle img-thumbnail">
                        </div>
                        <div class="mb-3">
                            <p class="text-muted">
                                {{ __('Change the logo of the organization here') }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control form-control-alternative" id="customFile" name="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="mb-3">
                                    <label for="name">@lang('category/users.name') *</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('Organization name')}}" value="{{$organization->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="mb-3">
                                    <label for="short_name">@lang('pdrnl.abbreviation') *</label>
                                    <input type="text" name="short_name" id="short_name" class="form-control" placeholder="@lang('pdrnl.abbreviation')" value="{{$organization->short_name}}" required>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted mb-4">{{ __('The fields with a star (*) must be completed at least.') }}</p>
                        <input type="hidden" name="oldImage" value="{{$organization->image}}">

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.adjust')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/manager/organizations.js"></script>
@endsection