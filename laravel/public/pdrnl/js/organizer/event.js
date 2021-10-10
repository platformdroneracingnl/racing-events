$(document).ready(function () {
    // Select2
    $(".select2").select2();

    $(".input-mask").inputmask();

    var date = new Litepicker({ 
        element: document.getElementById('event_date'),
        lang: 'nl',
        numberOfMonths: 2,
        numberOfColumns: 2,
        showWeekNumbers: true,
    });

    var start_registration = new Litepicker({ 
        element: document.getElementById('start_registration'),
        lang: 'nl',
        numberOfMonths: 2,
        numberOfColumns: 2,
        showWeekNumbers: true,
    });

    var end_registration = new Litepicker({ 
        element: document.getElementById('end_registration'),
        lang: 'nl',
        numberOfMonths: 2,
        numberOfColumns: 2,
        showWeekNumbers: true,
    });

    $("#description").length > 0 && tinymce.init({
        selector: "textarea#description",
        height: 300,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table directionality emoticons template paste"],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [{title:"Bold text",inline:"b"},{title:"Red text",inline:"span",styles:{color:"#ff0000"}},{title:"Red header",block:"h1",styles:{color:"#ff0000"}},{title:"Example 1",inline:"span",classes:"example1"},{title:"Example 2",inline:"span",classes:"example2"},{title:"Table styles"},{title:"Table row 1",selector:"tr",classes:"tablerow1"}],
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
});

// Upload location image
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