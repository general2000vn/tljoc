$('document').ready(function () {

    // $(".datepicker").datepicker({
    //     changeMonth: true,
    //     changeYear: true,
    //     dateFormat: 'yy/mm/dd',
    //     yearRange: "c-70:c+0",
    // });

    $('#btnAdd').click(function () {

        var oldIndex = getIDIndex($("#Search-Input div:last").attr('id'));

        $("#Search-Input div:first").clone().appendTo("#Search-Input");

        var newDiv = $("#Search-Input div:last");
        replaceID(newDiv, 1 + oldIndex);

        var inputCri = newDiv.children(':first');
        replaceID(inputCri, 1 + oldIndex);

        var inputOpe = $(inputCri).next();
        replaceID(inputOpe, 1 + oldIndex);

        var inputVal = $(inputOpe).next();
        replaceID(inputVal, 1 + oldIndex);

    });

    $('#btnDel').click(function () {
        var count = $("#Search-Input").children().length;
        if (count > 1) {
            var searchCriteria = $("#Search-Input div:last-child");

            searchCriteria.remove();
        }

    });

    $("#Search-Input").on('change', '.search-cri', function () {

        var newCri = this.value;
        var ope = $(this).next();
        var val = $(ope).next();
        var parentDiv = $(this).parent();
        var index = getIDIndex(parentDiv.attr('id'));
        val.remove();

        switch (newCri) {
            case "IcsParents.dob":
                parentDiv.append('<input type="text" class="search-tf search-val datepicker" placeholder="yyyy/mm/dd" id="search-val-' + index + '" name="search[value][' + index + ']">');
                break;

            case "IcsParents.occupation_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateParentOccupations(index);
                break;

            case "IcsParents.parent_status_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateParentParentStatuses(index);
                break;

            case "IcsParents.district_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateParentDistricts(index);
                break;

            case "Kids.dob":
                parentDiv.append('<input type="text" class="search-tf search-val datepicker" placeholder="yyyy/mm/dd" id="search-val-' + index + '" name="search[value][' + index + ']">');
                break;

            case "CourseTypesIcsParents.course_types_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateCourseTypes(index);
                break;
            
            case "IcsParents.nationality_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateNationalities(index);
                break;
                
            case "IcsParents.language_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateNationalities(index);
                break;
                
            case "IcsParents.other_language_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateNationalities(index);
                break;
            case "CourseTypes.id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateCourseTypes(index);
                break;
            case "Registrations.registration_status_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateRegistrationStatuses(index);
                break;
            case "CourseTypes.programme_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateProgrammes(index);
                break;
            case "Meetings.meeting_type_id":
                parentDiv.append('<select class="search-tf search-val" id="search-val-' + index + '" name="search[value][' + index + ']"><option value></option></select>');
                updateMeetingTypes(index);
                break;
            case "Meetings.start_date":
                parentDiv.append('<input type="text" class="search-tf search-val datepicker" placeholder="yyyy/mm/dd" id="search-val-' + index + '" name="search[value][' + index + ']">');
                break;
        }

        // $(".datepicker").datepicker({
        //     changeMonth: true,
        //     changeYear: true,
        //     dateFormat: '"yy/mm/dd"',
        //     yearRange: "c-70:c+0",
        // });


    });

    $("select#search-cri-0").change();

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

function replaceID(theElement, index) {
    var deli = "-";
    var oldID = theElement.attr('id');
    var pos = oldID.lastIndexOf(deli);
    var newID = oldID.slice(0, pos + 1) + index;
    theElement.attr("id", newID);
}

function updateMeetingTypes(index) {
    $.get({
        url: '../meeting-types/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['meetingTypes']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateProgrammes(index) {
    $.get({
        url: '../programmes/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['programmes']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateRegistrationStatuses(index) {
    $.get({
        url: '../registration-statuses/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['registrationStatuses']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateNationalities(index) {
    $.get({
        url: '../nationalities/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['nationalities']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateCourseTypes(index) {
    $.get({
        url: '../course-types/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['courseTypes']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateParentParentStatuses(index) {
    $.get({
        url: '../parent-statuses/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['parentStatuses']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateParentOccupations(index) {
    $.get({
        url: '../occupations/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['occupations']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function updateParentDistricts(index) {
    $.get({
        url: '../districts/get-list.json',
        success: function (data, status) {
            insertSelectOptions(index, data['districts']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
}

function insertSelectOptions(index, jsonData) {
    var selectElement = $('#search-val-' + index);
    console.log(selectElement.attr('id'));

    for (var k in jsonData) {
        selectElement.append('<option value="' + k + '">' + jsonData[k] + '</option>');
    }
    ;
}



