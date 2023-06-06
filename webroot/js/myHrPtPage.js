$('document').ready(function () {

    // var lastDivPack =  $("#other_tasks").children().last(); 

    // lastDivPack.clone().appendTo("#hidden_task");
    $("#hidden_task").hide();

    $('#btnAdd').click(function () {
        $("#hidden_task").children().last().clone().appendTo("#other_tasks");
        
        //var lastDivPack =  $("#Sib-Input div:last-child");
        var hiddenDivPack = $("#hidden_task").children().last();

        var oldIndex = getIDIndex(hiddenDivPack.attr('id'));

        replaceDivID(hiddenDivPack, oldIndex, oldIndex + 1);

        var inputDesc = hiddenDivPack.find('.task');
        replaceName(inputDesc, oldIndex, oldIndex + 1);
        replaceChildID(inputDesc, oldIndex, oldIndex + 1);

        var inputPIC = hiddenDivPack.find('.pic');
        replaceName(inputPIC, oldIndex, oldIndex + 1);
        replaceChildID(inputPIC, oldIndex, oldIndex + 1);

     
        // var inputHidden = hiddenDivPack.find('input[name="hr_pt_tasks[' + oldIndex + '][users][_ids]"]').last();
        // replaceName(inputHidden, oldIndex, oldIndex + 1);

        var newDiv = $("#other_tasks").children().last();
        
        var inputPIC = newDiv.find('.pic');
        var inputTask= newDiv.find('.task');

        inputTask.attr("name", 'hr_pt_tasks[' + (oldIndex + 1) + ']description');
        inputTask.attr("id", 'hr-pt-tasks-' + (oldIndex + 1) + '-description');

        inputPIC.attr("name", 'hr_pt_tasks[' + (oldIndex + 1) + '][users][_ids][]');
        inputPIC.attr("id", 'hr-pt-tasks-' + (oldIndex + 1) + '-users-ids');
        var oldClass = inputPIC.attr('class');
        var newClass = oldClass + " select2";
        inputPIC.attr("class", newClass);



        // var ulTag = $("#select2-hr-pt-tasks-" + oldIndex + "-users-ids-container").last();
        // replaceChildID(ulTag, oldIndex);

        // var textArea = $('textarea[aria-describedby="select2-hr-pt-tasks-' + oldIndex + '-users-ids-container"]').last();
        // replaceAttribute(textArea, 'aria-describedby', oldIndex);

        lastSelect2 = $("#other_tasks").children().last().find('.pic');

        // lastSelect2.select2({
        //     placeholder: "Type to search ...",
        //     allowClear: true
        // });

    });

    $('#btnDel').click(function () {
        if ($("#other_tasks").children().length > 0) {
        
        var lastDiv = $("#other_tasks").children().last();
        lastDiv.remove();
        
        var hiddenDivPack = $("#hidden_task").children().last();

        var oldIndex = getIDIndex(hiddenDivPack.attr('id'));

        replaceDivID(hiddenDivPack, oldIndex, oldIndex - 1);

        var inputDesc = hiddenDivPack.find('.task');
        replaceName(inputDesc, oldIndex, oldIndex - 1);
        replaceChildID(inputDesc, oldIndex, oldIndex - 1);

        var inputPIC = hiddenDivPack.find('.pic');
        replaceName(inputPIC, oldIndex, oldIndex - 1);
        replaceChildID(inputPIC, oldIndex, oldIndex - 1);

        var inputHidden = hiddenDivPack.find('input[name="hr_pt_tasks[' + oldIndex + '][users][_ids]"]').last();
        replaceName(inputHidden, oldIndex, oldIndex - 1);


        }

    });

    $('.select2').select2({
        placeholder: "Type to search ...",
        allowClear: true
    });
});


function getIDIndex(id) {
    var idIndex = 0;
    var deli = "-";
    var pos = id.lastIndexOf(deli);


    if ((pos !== -1) && (pos !== id.length - 1)) {
        idIndex = id.slice(1 + pos, id.length);
    }

    return parseInt(idIndex);
}

function replaceDivID(theElement, oldIndex, newIndex) {
    var oldID = theElement.attr('id');
    var newID = oldID.replace("-" + oldIndex, "-" + newIndex);
    theElement.attr("id", newID);
}

function replaceChildID(theElement, oldIndex, newIndex) {
    var deli = "-";
    var oldID = theElement.attr('id');
    var newID = oldID.replace("-" + oldIndex + "-", "-" + newIndex + "-");
    theElement.attr("id", newID);
}

function replaceName(theElement, oldIndex, newIndex) {
    var oldName = theElement.attr('name');
    var newName = oldName.replace("[" + oldIndex + "]", "[" + newIndex + "]");
    theElement.attr("name", newName);
}

function replaceAttribute(theElement, attribute, oldIndex, newIndex) {
    var oldAttribute = theElement.attr(attribute);
    var newAttribute = oldAttribute.replace("-" + oldIndex + "-", "-" + newIndex + "-");
    theElement.attr(attribute, newAttribute);
}

// function replaceName(theElement, newIndex) {
//     var deli1 = "[";
//     var deli2 = "]";
//     var oldName = theElement.attr('name');
//     var pos1 = oldName.indexOf(deli1);
//     var part1 = oldName.slice(0, pos1 + 1);
//     var pos2 = oldName.indexOf(deli2);
//     var part2 = oldName.slice(pos2);
//     var newName = part1 + newIndex + part2;
//     theElement.attr("name", newName);
// }