$(document).ready( function () {
    var lang;
    // console.log(locale);

    if (locale == "nl") {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/Dutch.json";
    } else {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json";
    }

    var dataTable = $('#usersTable').DataTable({
        paging: true,
        scrollX: true,
        lengthChange: false,
        deferRender: true,
        info: true,
        language: {
            url: lang,
        },
        columnDefs: [
            {
                "orderable": false,
                "targets": [2, 8]
            }
        ]
    });

    // Let custom search box work with dataTables
    $('#searchbox').keyup(function(){
        dataTable.search($(this).val()).draw() ;
    })
});