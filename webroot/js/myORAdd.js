/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// (function($) { // for Select box
// 	"use strict";
	
// 		//MULTI
// 		window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3, selectAll:true, captionFormatAllSelected: "Yeah, OK, so everything." });
//         window.Search = $('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
// 		window.sb = $('.SlectBox-grp-src').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.', selectAll:true });
// 		$('.testselect1').SumoSelect();
// 		$('.testselect2').SumoSelect();
// 		$('.select1').SumoSelect({ okCancelInMulti: true, selectAll: true });
// 		$('.select3').SumoSelect({ selectAll: true });
// 		$('.search_test').SumoSelect({search: true, searchText: 'Enter here.'});
		
		
		
		
// 		// SELECT BOX
// 		var select = document.getElementById('partners-ids');
// 		multi(select, {
// 			non_selected_header: 'Suppliers List',
// 			selected_header: 'Suggested Suppliers'
// 		});

// })(jQuery);

$('document').ready(function () {

    $('#btn-add-supplier').click(function () {
        //label_block = '<div class="row">';
        label_block = '<div class="col-md-4"> <label class="form-label required" for="">Name</label> </div>';
        label_block += '<div class="col-md-3"> <label class="form-label" for="">Representative</label> </div>';
        label_block += '<div class="col-md-4"> <label class="form-label" for="">Contact</label> </div>';
        label_block += '<div class="col-md-1"> <label class="form-label" for="">Delete</label> </div>';
        //label_block += '</div>';
        
        item_block = '<div class="row" id="supplier-0-">';
        item_block += '<div class="col-md-4"><div class="form-group"><input type="text" name="or_suppliers[0][name]" class="form-control supplier_name" id="or-suppliers-0-name" maxlength="40"></div></div>';
        item_block += '<div class="col-md-3"><div class="form-group"><input type="text" name="or_suppliers[0][rep]" class="form-control supplier_rep" id="or-suppliers-0-rep" maxlength="40"></div></div>';
        item_block += '<div class="col-md-4"><div class="form-group"><input type="text" name="or_suppliers[0][contact]" class="form-control supplier_contact" id="or-suppliers-0-contact" maxlength="40"></div></div>';
        item_block += '<div class="col-md-1"><button class="btn btn-remove-supplier btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_supplier-0-" type="button"><i class="fe fe-trash"></i></button></div>';
        item_block += '</div>';

        listDiv = $("#supplier_list");
        labelDiv = $("#supplier_label");

        if (listDiv.children().last().length == 0) {
            labelDiv.empty();
            labelDiv.append(label_block);
            listDiv.append(item_block);
        } else {
            lastRowDiv = listDiv.children().last();

            oldIndex = getIDIndex(lastRowDiv.attr('id'));

            //lastRowDiv.clone().appendTo("#item_list");
            listDiv.append(item_block);

            newRowDiv = listDiv.children().last();
            replaceID(newRowDiv, 0, 1 + oldIndex);

            inputName = newRowDiv.find('.supplier_name');
            replaceID(inputName, 0, 1 + oldIndex);
            replaceName(inputName, 0, 1 + oldIndex);

            inputRep = newRowDiv.find('.supplier_rep');
            replaceID(inputRep, 0, 1 + oldIndex);
            replaceName(inputRep, 0, 1 + oldIndex);

            inputContact = newRowDiv.find('.supplier_contact');
            replaceID(inputContact, 0, 1 + oldIndex);
            replaceName(inputContact, 0, 1 + oldIndex);

            btnRemove = newRowDiv.find('.btn-remove-supplier');
            replaceID(btnRemove, 0, 1 + oldIndex);
        }

        registerAllRemoveButton();

    });
    

    $('#btn-add-item').click(function () {
        
        item_label = '<div class="col-md-2"> <label class="form-label" for="">Item Code</label> </div>';
        item_label += '<div class="col-md-5"> <label class="form-label required" for="">Item Name</label> </div>';
        item_label += '<div class="col-md-2"> <label class="form-label required" for="">Quantity</label> </div>';
        item_label += '<div class="col-md-2"> <label class="form-label" for="">Est. Unit Price</label> </div>';
        item_label += '<div class="col-md-1"> <label class="form-label" for="">Delete</label> </div>';
    
        
        item_block = '<div class="row" id="item-0-">';
        item_block += '<div class="col-md-2"><div class="form-group"><input type="text" name="or_items[0][code]" class="form-control item_code" id="or-items-0-code" maxlength="20"></div></div>';
        item_block += '<div class="col-md-5"><div class="form-group"><textarea name="or_items[0][name]" class="form-control item_name" rows="3" required="required" data-validity-message="This field cannot be left empty" id="or-items-0-name"></textarea></div></div>';
        item_block += '<div class="col-md-2"><div class="form-group"><input type="number" name="or_items[0][quantity]" class="form-control item_quantity" required="required" data-validity-message="This field cannot be left empty" id="or-items-0-quantity"></div></div>';
        item_block += '<div class="col-md-2"><div class="form-group"><input type="number" name="or_items[0][price]" class="form-control item_price numeric" data-validity-message="This field cannot be left empty" id="or-items-0-price"></div></div>';
        item_block += '<div class="col-md-1"><button class="btn btn-remove-item btn-danger  btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_item-0-" type="button"><i class="fe fe-trash"></i></button></div>';
        item_block += '</div>';

        listDiv = $("#item_list");
        labelDiv = $("#item_label");

        if (listDiv.children().last().length == 0) {
            labelDiv.empty();
            labelDiv.append(item_label);
            listDiv.append(item_block);
        } else {
            lastRowDiv = listDiv.children().last();

            oldIndex = getIDIndex(lastRowDiv.attr('id'));

            //lastRowDiv.clone().appendTo("#item_list");
            listDiv.append(item_block);

            newRowDiv = listDiv.children().last();
            replaceID(newRowDiv, 0, 1 + oldIndex);

            inputCode = newRowDiv.find('.item_code');
            replaceID(inputCode, 0, 1 + oldIndex);
            replaceName(inputCode, 0, 1 + oldIndex);

            inputName = newRowDiv.find('.item_name');
            replaceID(inputName, 0, 1 + oldIndex);
            replaceName(inputName, 0, 1 + oldIndex);

            inputQuantity = newRowDiv.find('.item_quantity');
            replaceID(inputQuantity, 0, 1 + oldIndex);
            replaceName(inputQuantity, 0, 1 + oldIndex);

            inputPrice = newRowDiv.find('.item_price');
            replaceID(inputPrice, 0, 1 + oldIndex);
            replaceName(inputPrice, 0, 1 + oldIndex);

            btnRemove = newRowDiv.find('.btn-remove-item');
            replaceID(btnRemove, 0, 1 + oldIndex);
        }

        registerAllRemoveButton();
        //addNumericEventListener();
        jQuery.each($('.numeric'), function (i, item) {
            //alert(item);
            changeFormat(item);
        });

    });

    $('#btn-add-upload').click(function () {

        upload_label = '<div class="col-md-6"> <label class="form-label required" for="">Description</label> </div>';
        upload_label += '<div class="col-md-5"> <label class="form-label required" for="">File</label> </div>';
        upload_label += '<div class="col-md-1"> <label class="form-label" for=""></label> </div>';


        upload_block = '<div class="row" id="upload-0-">';
        upload_block += '<div class="col-md-6"><div class="form-group"><input type="text" name="or_uploads[0][name]" class="form-control upload_name" required="required" id="or-uploads-0-name" maxlength="200"></div></div>';
        upload_block += '<div class="col-md-5"><div class="form-group"><input type="file" name="or_uploads[0][filename]" class="form-control upload_filename" required="required" id="or-uploads-0-filename"></div></div> ';
        upload_block += '<div class="col-md-1"><button class="btn btn-remove-upload btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_upload-0-" type="button"><i class="fe fe-trash"></i></button></div>';
        upload_block += '</div>';


        labelDiv = $("#upload_label");
        listDiv = $("#upload_list");

        if (listDiv.children().last().length == 0) {
            labelDiv.empty();
            labelDiv.append(upload_label);
            listDiv.append(upload_block);
        } else {
            lastRowDiv = listDiv.children().last();

            oldIndex = getIDIndex(lastRowDiv.attr('id'));

            //lastRowDiv.clone().appendTo("#upload_list");
            listDiv.append(upload_block);

            newRowDiv = listDiv.children().last();
            replaceID(newRowDiv, 0, 1 + oldIndex);

            inputName = newRowDiv.find('.upload_name');
            replaceID(inputName, 0, 1 + oldIndex);
            replaceName(inputName, 0, 1 + oldIndex);

            inputFile = newRowDiv.find('.upload_filename');
            replaceID(inputFile, 0, 1 + oldIndex);
            replaceName(inputFile, 0, 1 + oldIndex);

            btnRemove = newRowDiv.find('.btn-remove-upload');
            replaceID(btnRemove, 0, 1 + oldIndex);
        }

        registerAllRemoveButton();

    });

    registerAllRemoveButton();

});

function registerAllRemoveButton() {
    $('.btn-remove-item').click(function () {
        rowIndex = getIDIndex(this.id);

        idText = "#item-" + rowIndex + "-";

        rowDiv = $(idText);

        rowDiv.remove();

    });

    $('.btn-remove-upload').click(function () {
        rowIndex = getIDIndex(this.id);

        idText = "#upload-" + rowIndex + "-";

        rowDiv = $(idText);

        rowDiv.remove();

    });

    $('.btn-remove-supplier').click(function () {
        rowIndex = getIDIndex(this.id);

        idText = "#supplier-" + rowIndex + "-";

        rowDiv = $(idText);

        rowDiv.remove();

    });
}

function getIDIndex(id) {
    idIndex = 0;
    deli = "-";
    pos1 = id.indexOf(deli);
    pos2 = id.lastIndexOf(deli);


    if ((pos1 !== -1) && (pos2 !== - 1)) {
        idIndex = id.slice(1 + pos1, pos2);
    }
    //alert(idIndex);
    return parseInt(idIndex);
}

function replaceID(theElement, oldIndex, newIndex) {

    oldID = theElement.attr('id');
    oldText = "-" + oldIndex + "-";
    newID = oldID.replace(oldText, "-" + newIndex + "-");
    theElement.attr("id", newID);
}

function replaceName(theElement, oldIndex, newIndex) {

    oldName = theElement.attr('name');
    oldText = "[" + oldIndex + "]";
    newName = oldName.replace(oldText, "[" + newIndex + "]");
    theElement.attr("name", newName);
}


function updateDistricts(jElement) {
    $.get({
        url: '../districts/get-list.json',
        success: function (data, status) {
            insertSelectOptions(jElement, data['districts']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateWards(jElement, districtID) {
    var districtLink = '../districts/get-list/' + districtID + '.json';

    $.get({
        url: districtLink,
        success: function (data, status) {
            insertSelectOptions(jElement, data['districts']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function insertSelectOptions(jElement, jsonData) {
    $(jElement).children().remove();

    for (var k in jsonData) {
        $(jElement).append('<option value="' + k + '">' + jsonData[k] + '</option>');
    }
    ;
}




