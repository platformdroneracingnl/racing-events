@extends('layouts.backend.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Header -->
                        <div class="col-12 col-md-6">
                            <h3 class="mb-0">QR Code scannen</h3>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <a class="btn btn-secondary btn-on-mobile ms-1" href="{{ url()->previous() }}"><i class="mdi mdi-arrow-left me-2"></i> @lang('button.back')</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div id="qr-reader" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            // console.log(`Code scanned = ${decodedText}`, decodedResult);
            $(location).attr('href', decodedText);
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 270 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection