$(document).ready(function() {
    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[data-role="organization"]').filter(function() {
            $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
        });
    });
});

// Upload organization image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Change image preview
$("#customFile").change(function(){
    readURL(this);
});