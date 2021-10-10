@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Management @endslot
        @slot('title') {{ __('Race teams') }} @endslot
    @endcomponent

    <div class="row">
        {{ $raceteam }}
    </div>
@endsection