$(document).ready(function() {
    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[data-role="location"]').filter(function() {
            $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
        });
    });
});