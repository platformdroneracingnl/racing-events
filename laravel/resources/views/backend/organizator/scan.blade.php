@extends('layouts.backend.master')

@section('title')
    {{ __('Scan') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-7">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">Drone racer - check in</h3>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <a class="btn btn-secondary btn-on-mobile ms-1" href="{{ url()->previous() }}"><i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        USB Barcode Scanner
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form id="scanForm">
                                            <div class="col-12">
                                                <p class="text-muted">{{ __('Do you use a USB barcode scanner? Then click in the input field and scan the QR code of the participant') }}.</p>
                                                <div class="alert alert-dismissible fade alert-danger" role="alert" style="display: none">
                                                    <p class="mb-0"></p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="scan_input">Barcode ID *</label>
                                                    <!-- <input class="form-control my-input" id="scan_input" type="url" name="name" placeholder="Name" autofocus> -->
                                                    <input class="form-control" type="search" onfocus="this.value=''" id="scanInput" autocomplete="off" required autofocus/>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Zoek registratie</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" onclick="webcamScan()" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Use Webcam (internal or USB)
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="text-muted">{{ __("Use a webcam (internal or USB) to scan the participant's QR code") }}.</p>
                                        <div class="alert alert-dismissible fade alert-danger" role="alert" style="display: none">
                                            <p class="mb-0"></p>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <div id="qr-reader" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('pdrnl')}}/js/scan.js"></script>
@endsection