$(function (e) {
    "use strict";

    var table = $('.table').DataTable({

        buttons: [
            // {
            //     text :'excel',
            //     className: 'btn btn-primary btn-sm buttons-excel buttons-html5'
            // }
            'excel',
            'colvis'
        ],
        order: [[0, 'asc']],
        language: {
            searchPlaceholder: 'Filter...',
            scrollX: "100%",
            sSearch: '',
        },
        searching : true
    });

    table.buttons().container()
        .appendTo('.dataTables_wrapper .col-md-6:eq(0)');

});