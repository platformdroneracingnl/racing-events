@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') PDRNL @endslot
        @slot('title') Nieuws @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card shadow">
                <div class="card-body">
                    <!-- Header -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Body -->
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card shadow">
                            <div class="card-header">
                                <a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! $item->get_description() !!}</p>
                            </div>
                            <div class="card-footer">
                                <small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection