$(function (e) {
    "use strict";

    var table = $('#user-list').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        order: [[0, 'asc']],
        language: {
            searchPlaceholder: 'Filter...',
            scrollX: "100%",
            sSearch: '',
        }
    });

    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

});