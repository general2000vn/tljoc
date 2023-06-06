
$('document').ready(function () {



    jQuery.each($('.numeric'), function (i, item) {

        changeFormat(item);
    });

    addNumericEventListener();
/*
    // Add an event listener to the input element for 'input' events
    $('.numeric').on('input', function () {
        // Get the current value of the input
        let value = $(this).val();

        // Remove any non-digit characters from the input
        value = value.replace(/[^\d]/g, '');

        // Add thousand separators to the input value
        value = Number(value).toLocaleString(undefined, { groupingSeparator: ',' });

        // Set the formatted value back into the input
        $(this).val(value);
    });
*/
});

function addNumericEventListener() {
    $('.numeric').on('input', function () {
        // Get the current value of the input
        let value = $(this).val();

        // Remove any non-digit characters from the input
        value = value.replace(/[^\d]/g, '');

        // Add thousand separators to the input value
        value = Number(value).toLocaleString(undefined, { groupingSeparator: ',' });

        // Set the formatted value back into the input
        $(this).val(value);

    });
}

function changeFormat(item) {
    let value = item.value;

    
    if (value.length > 0) {

        // Remove any non-digit characters from the input
        value = value.replace(/[^\d]/g, '');

        // Add thousand separators to the input value
        value = Number(value).toLocaleString(undefined, { groupingSeparator: ',' });

        // Set the formatted value back into the input
        item.value = value;
    }
}