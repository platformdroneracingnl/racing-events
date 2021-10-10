@extends('layouts.backend.master')

@section('title')
    Create new race team - Management
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Race teams') }} @endslot
    @endcomponent

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('management.race_teams.store')}}" method="POST" enctype="multipart/form-data" role="form">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <h4 id="name" class="mb-0">{{ __('Create new race team') }}</h4>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="text-end">
                                    <a href="{{ route('management.race_teams.index') }}" class="me-1 btn btn-secondary waves-effect waves-light btn-on-mobile">
                                        <i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.save')</button>
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
                        <!-- Race team image -->
                        <div class="mb-3">
                            <img id="img-upload" src="{{ asset('pdrnl') }}/img/ateam.png" alt="Your race team image"
                                    class="avatar-xxxl rounded-circle img-thumbnail">
                        </div>
                        <div class="mb-3">
                            <p class="text-muted">
                                {{ __('Upload a logo for the race team') }}
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
                                    <label class="form-label" for="name">@lang('category/users.name') *</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{__('Race Team name')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="description">{{ __('Description') }}</label>
                                    <textarea class="form-control" style="height:100px" name="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted mb-4">{{ __('The fields with a star (*) must be completed at least.') }}</p>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('pdrnl')}}/js/manager/race_teams.js"></script>
@endsection