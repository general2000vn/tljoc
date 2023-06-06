
$(document).ready(function () {
    $('.select2').select2({
        placeholder: "Type to search ...",
        allowClear : true
    });



    $('.mySelect2.selectDocIn').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/doc-incomings/ajax-search.json',
            url: fullBaseUrl + 'doc-incomings/ajax-search.json',
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

    $('.mySelect2.selectDocOut').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/doc-outgoings/ajax-search.json',
            url: fullBaseUrl + 'doc-outgoings/ajax-search.json',
            delay: 250,

            data: function (params) {
                var query = {
                    criteria: params.term

                };

                return query;
            }

        }
    });

    $('.mySelect2.selectPartner').select2({
        placeholder: "Type to search ...",
        allowClear : true,
        ajax: {
            //url: 'http://ict/cake4/partners/ajax-search.json',
            url: fullBaseUrl + 'partners/ajax-search.json',
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