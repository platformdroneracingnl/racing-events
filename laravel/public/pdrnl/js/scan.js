function onScanSuccess(decodedText, decodedResult) {
    // console.log(`Code scanned = ${decodedText}`, decodedResult);
    $(location).attr('href', decodedText);
}

function webcamScan() {
    var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 270 });
    html5QrcodeScanner.render(onScanSuccess);
}

var AlertMsg = $('div[role="alert"]');
$('#closeAlert').on('click', function() {
    $(AlertMsg).hide();
});

$('#scanForm').submit(function(e){
    e.preventDefault();
    var barcode = $('#scanInput').val();
    var url = '/event/check-in/'+barcode;

    $.ajax({
        type: 'GET',
        url: url,
        success: function() {
            window.location = url;
        },
        error: function(jqXhr){
            if( jqXhr.status === 500 )
                $(AlertMsg).text("De registratie komt niet voor in de database.");
                $(AlertMsg).addClass("show");
                $(AlertMsg).show();
            if( jqXhr.status === 404 )
                $(AlertMsg).text("De verkeerde QR code is gescand!");
                $(AlertMsg).addClass("show");
                $(AlertMsg).show();
        },
    });
});

// let inputStart, inputStop;
// $("#scanInput")[0].onpaste = e => e.preventDefault();
// // handle a key value being entered by either keyboard or scanner
// var lastInput

// let checkValidity = () => {
//     if ($("#scanInput").val().length < 10) {
//         $("#scanInput").val('')
//     }
//     timeout = false
//     // var barcode = $("#scanInput").val();
//     // $(location).attr('href', barcode);
// }

// let timeout = false
// $("#scanInput").keypress(function (e) {
//     if (performance.now() - lastInput > 500) {
//         $("#scanInput").val('')
//     }
//     lastInput = performance.now();
//     if (!timeout) {
//         timeout = setTimeout(checkValidity, 200)
//     }
// });