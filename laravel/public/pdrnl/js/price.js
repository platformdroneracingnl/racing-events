$(document).ready(function () {
    $("#price").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
    });
});