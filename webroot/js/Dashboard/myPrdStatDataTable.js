$(function (e) {
    "use strict";

    var table = $('#dashboard-prd').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        order: [[0, 'desc']],
        language: {
            searchPlaceholder: 'Filter...',
            scrollX: "100%",
            sSearch: '',
        }
    });

    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

});