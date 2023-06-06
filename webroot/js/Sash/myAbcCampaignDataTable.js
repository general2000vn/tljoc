$(function (e) {
    "use strict";

    var table = $('.table').DataTable({
        //buttons: ['excel','colvis'],
        order: [[0, 'desc']],
        language: {
            searchPlaceholder: 'Filter...',
            scrollX: "100%",
            sSearch: '',
        }
    });

    table.buttons().container()
        .appendTo('.dataTables_wrapper .col-md-6:eq(0)');

});