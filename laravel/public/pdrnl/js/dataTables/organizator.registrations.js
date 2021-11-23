$(document).ready( function () {
    // Select2
    $(".select2").select2();

    var lang;
    // console.log(locale);

    if (locale == "nl") {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/Dutch.json";
    } else {
        lang = "//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json";
    }

    var dataTable = $('#registrationsTable').DataTable({
        paging: true,
        pageLength: 25,
        scrollX: false,
        deferRender: true,
        info: true,
        language: {
            url: lang,
        },
        columnDefs: [
            {orderable: false, targets: [0,1,10]},
        ],
        // select: {
        //     style: 'multi'
        // },
        order: [[ 1, "asc" ]]
    });

    // Let custom search box work with dataTables
    $('#searchbox').keyup(function(){
        dataTable.search($(this).val()).draw() ;
    });

    var masterCheck = $("#masterCheck");
    var listCheckItems = $("#check :checkbox");

    masterCheck.on("click", function() {
        var isMasterChecked = $(this).is(":checked");
        listCheckItems.prop("checked", isMasterChecked);
    });

    listCheckItems.on("change", function() {
        var totalItems = (listCheckItems.length);
        var checkedItems = listCheckItems.filter(":checked").length;

        if (totalItems == checkedItems) {
            // When all selected
            masterCheck.prop("indeterminate", false);
            masterCheck.prop("checked", true);
        } else if (checkedItems > 0 && checkedItems < totalItems) {
            // When selecting one
            masterCheck.prop("indeterminate", true);
        } else {
            // When all checkboxes are unchecked
            masterCheck.prop("indeterminate", false);
            masterCheck.prop("checked", false);
        }
    });
});