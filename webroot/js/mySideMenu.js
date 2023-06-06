$(document).ready(function () {

    //find all .has-dropdown item
    $( ".has-dropdown" ).children('ul').each(function (index, element) {
        $(this).attr('id', 'collapse-' + index);
        
        var linkEl = $(this).siblings('a').first();

        linkEl.attr('role', 'button');
        linkEl.attr('data-bs-toggle', 'collapse');
        linkEl.attr('data-bs-target', '#collapse-' + index);
    });

    $( ".has-dropdown.active" ).children('ul').each(function (index, element) {
        $(this).addClass( "show" );

    });

    // iCount = 0;

    // //add ID and Class to its child
    // hasDropdowns.each(function (iIndex, dropdownElement){ 
    //     var listEl = dropdownElement.children('ul');
    //     listEl.attr('id', 'collapse-' + iIndex);
        
    
    
    //     linkEl = hasDropdownElement.children('a');
    //     linkEl.attr('role', 'button');
    //     linkEl.attr('data-bs-toggle', 'collapse');
    //     linkEl.attr('data-bs-target', '#collapse-' + iIndex);
    
    // });
    

});

// function addIdAndClass(hasDropdownElement, iIndex){ 
//     listEl = hasDropdownElement.children('ul');
//     listEl.attr('id', 'collapse-' + iIndex);
    


//     linkEl = hasDropdownElement.children('a');
//     linkEl.attr('role', 'button');
//     linkEl.attr('data-bs-toggle', 'collapse');
//     linkEl.attr('data-bs-target', '#collapse-' + iIndex);

// }

function closeAllOtherDropdown(){

}

function closeDropdown(ulElement) {

}