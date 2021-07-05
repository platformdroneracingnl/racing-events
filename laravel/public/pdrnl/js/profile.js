$(function(){
    // Open a panel directly with an href hashtag
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});

$('#profile-list a').on('click', function (e) {
    // Let the user switch between tabs
    e.preventDefault()
    $(this).tab('show')
});

$('#customFile').on('change',function(){
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
});

$("#show_hide_password a").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
    }
});

var today = new Date();
var birth_day = new Litepicker({ 
    element: document.getElementById('input-date-of-birth'),
    lang: 'nl',
    format: 'DD-MM-YYYY',
    showWeekNumbers: true,
    dropdowns: {
        minYear: 1900,
        maxYear: null,
        months: true,
        years: true,
    },
    maxDate: today
});