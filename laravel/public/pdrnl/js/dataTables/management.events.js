$(document).ready( function () {
    var lang;
    // console.log(locale);

    if (locale == "nl") {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/Dutch.json";
    } else {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json";
    }

    var dataTable = $('#eventsTable').DataTable({
        responsive:{
            details: {
                display: $.fn.dataTable.Responsive.display.modal()
            }
        },
        // responsive: true,
        paging: true,
        scrollX: false,
        lengthChange: false,
        deferRender: true,
        info: true,
        language: {
            url: lang,
        },
        columnDefs: [
            {orderable: false, targets: [9, 4]},
        ]
    });

    // Let custom search box work with dataTables
    $('#searchbox').keyup(function(){
        dataTable.search($(this).val()).draw() ;
    })
});