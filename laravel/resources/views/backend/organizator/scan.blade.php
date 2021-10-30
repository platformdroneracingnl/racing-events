@extends('layouts.backend.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3 text-center">
                        <!-- Header -->
                        <div class="col-12">
                            <h3 class="mb-0">QR Code scannen</h3>
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