$(document).ready(function () {
    // upon click, add a new dynamic row of fields
    $('#btn_field_add').click(function () {
        addField();
    });
    
    var global_id = "";
    var global_key = "";
    var global_paths = "";
    var global_html = "";
    
    // records to be deleted
    // upon click, delete the selected row
    $(document).on('click', '.btn_field_delete', function() {
        global_key = $(this).val();
        global_id = $(this).closest('div').attr('id');
        global_html = $(this).closest('#' + global_id);
        
        // if already stored in the database, ask for confirmation
        if ($(this).val() != "") {
            $('#confirm_delete').modal('toggle');
        } else {
            var count = $('input[name=hdn_actual_count]').val() - 1;
            $('input[name=hdn_actual_count]').val(count);
            
            $('#' + global_id).slideUp('slow', function () {
                $('#' + global_id).remove();
                global_html.remove();
            });
        }
    });
    
    // delete record
    $('#modal_btn_yes').click(function() {
        var count = $('input[name=hdn_actual_count]').val() - 1;
        $('input[name=hdn_actual_count]').val(count);
        
        $('#' + global_id).slideUp('slow', function () {
            $('#' + global_id).remove();
            global_html.remove();
        });
        
        var fd = new FormData(document.getElementById("form_delete"));
        $.ajax({
            url: $('input[name=base_url]').val() + '/user_contact/' + global_key,
            type: "POST",
            data: fd,
            enctype: 'multipart/form-data',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            
        });
        
        $('#confirm_delete').modal('hide');
    });
});

// add a new row of dynamic fields
function addField() {
    // how many "duplicatable" input fields we currently have
    var old_count = parseInt($('input[name=hdn_increment]').val());
    // the numeric ID of the new input field being added
    var new_count = new Number(old_count + 1); 
    // create the new element via clone(), and manipulate it's ID using new_count value
    var newElem = $('#record_' + '1').clone().attr('id', 'record_' + new_count).fadeIn('slow').attr("style", "");
    
    // count the number of row added
    $('input[name=hdn_increment]').val(new_count);
    $('input[name=hdn_actual_count]').val(parseInt($('input[name=hdn_actual_count]').val()) + 1);
    
    // flag property 
    newElem.find('[name=hdn_index' + '1' + ']')
        // ID
        .attr('id', 'hdn_index' + new_count)
        // Name
        .attr('name', 'hdn_index' + new_count)
        .val("Y");

    // button property
    newElem.find('.btn_field_delete')
        // ID
        .attr('id', 'btn_field_delete' + new_count)
        // Name
        .attr('name', 'btn_field_delete' + new_count)
        // Value
        .attr('value', '')
        .attr('class', 'btn btn-danger btn-xs btn_field_delete')
        .removeClass('hidden');
        
    // button property
    newElem.find('.btn_field_add')
    // ID
    .attr('id', 'btn_field_add')
    // Name
    .attr('name', 'btn_field_add')

    .attr('class', 'btn btn-success btn-xs btn_field_delete')
    .addClass('hidden');

    if ($("input[name=hdn_setup]").val() == "phone_number") {
        newElem = dynamicUserCountryCall(newElem, new_count);
        newElem = dynamicUserPhoneNumber(newElem, new_count);
        
    }
    
    // insert the new element after the last "duplicatable" input field
    $("div.clonedField:last").after(newElem);
}

function dynamicUserCountryCall(element, count) {
    // change the select label attribute
    element.find('.label_input_country_key' + '1')
        .attr('class', 'select label_input_country_key' + count);
        
    element.find('.label_country_key1')
        .removeClass('fa fa-asterisk');
    
    // Country Call
    // property
    element.find('.input_country_key' + '1')
        // ID
        .attr('id', 'country_key' + count)
        // Name
        .attr('name', 'country_key' + count)
        // Value
        .val('' )
        // Class
        .attr('class', 'input_country_key' + count);
        
    // change the error attribute
    element.find('.error_input_country_key1')
        .attr('class', 'invalid error-msg error_input_country_key' + count)
        .html('&nbsp;');
        
    return element;
}

function dynamicUserPhoneNumber(element, count) {
    // change the select label attribute
    element.find('.label_input_user_contact_phone_number' + '1')
        .attr('class', 'input label_user_contact_phone_number' + count);
        
    // Phone Number
    // property
    element.find('.input_user_contact_phone_number' + '1')
        // ID
        .attr('id', 'user_contact_phone_number' + count)
        // Name
        .attr('name', 'user_contact_phone_number' + count)
        // Value
        .attr('value', '')
        // Class
        .attr('class', 'input_user_contact_phone_number' + count);
        
    // change the error attribute
    element.find('.error_input_user_contact_phone_number1')
        .attr('class', 'invalid error-msg error_input_user_contact_phone_number' + count)
        .html('');
        
    return element;
}