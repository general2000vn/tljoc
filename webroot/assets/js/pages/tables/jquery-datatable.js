$(function () {
    $('.js-basic-example').DataTable(
        {
            "pageLength": 20
        }
        
    );

    //Exportable table
    $('.js-exportable').DataTable({
        "pageLength": 20,
        dom: 'Bfrtip',
        buttons: [
            //'copy', 'csv', 'excel', 'pdf', 'print'
            'excel', 'pdf', 'print'
        ]
    });
});