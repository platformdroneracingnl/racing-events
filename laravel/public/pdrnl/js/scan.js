function onScanSuccess(decodedText, decodedResult) {
    // console.log(`Code scanned = ${decodedText}`, decodedResult);
    // $(location).attr('href', decodedText);
    validateCode(decodedText);
}

function webcamScan() {
    var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 300 });
    html5QrcodeScanner.render(onScanSuccess);
}

var AlertMsg = $('div[role="alert"]');
$('#closeAlert').on('click', function() {
    $(AlertMsg).hide();
});

$('#scanForm').submit(function(e){
    e.preventDefault();
    let barcode = $('#scanInput').val();
    validateCode(barcode);
});

function validateCode(input_barcode) {
    var url = '/event/check-in/'+input_barcode;
    $.ajax({
        type: 'GET',
        url: url,
        success: function() {
            window.location = url;
        },
        error: function(jqXhr){
            if( jqXhr.status === 500 )
                $(AlertMsg).text("De registratie komt niet voor in de database.");
            if( jqXhr.status === 404 )
                $(AlertMsg).text("Er is wat mis gegaan, vraag hulp aan de beheerder.");
            $(AlertMsg).addClass("show");
            $(AlertMsg).show();
        },
    });
}