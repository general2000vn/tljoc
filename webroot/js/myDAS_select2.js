$(document).ready(function () {

    // $('.select2').select2({
    //     placeholder: "Type to search ...",
    //     allowClear : true
    // });
    
    
    $('.selectDocIn').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/doc-incomings/ajax-search.json',
            url: APP_FULL_BASE + 'doc-incomings/ajax-search.json',
            delay: 250,

            data: function (params) {
                if (params.term != "") {
                    var query = {
                        criteria: params.term

                    };
                }

                return query;
            }

        }
    });

    $('.selectDocOut').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/doc-outgoings/ajax-search.json',
            url: APP_FULL_BASE + 'doc-outgoings/ajax-search.json',
            delay: 250,

            data: function (params) {
                var query = {
                    criteria: params.term

                };

                return query;
            }

        }
    });

    $('.selectPartner').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/partners/ajax-search.json',
            url: APP_FULL_BASE + 'partners/ajax-search.json',
            delay: 250,

            data: function (params) {
                if (params.term != "") {
                    var query = {
                        criteria: params.term

                    };
                }
                return query;
            }

        }
    });
});