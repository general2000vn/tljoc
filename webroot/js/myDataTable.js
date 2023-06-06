$(function (e) {
    "use strict";
    var table = $('#my-datatable').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        language: {
            searchPlaceholder: 'Filter...',
            scrollX: "100%",
            sSearch: '',
        }
    });

    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

});