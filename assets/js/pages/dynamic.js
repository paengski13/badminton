$(document).ready(function () {
    var id = "";
    var row = "";

    // upon click, add a new dynamic row of fields
    $('#btn_add').click(function () {
        addForm();
    });
    
    $("#btn_delete_yes").click(function () {
        var count = $('input[name=hdn_actual_count]').val() - 1;
        $('input[name=hdn_actual_count]').val(count);
    
         // display animation
        $('.js-loading-bar').modal('show');
        $('.progress-bar').addClass('animate');

        $.ajax({
            url: $('input[name=base_url]').val() + '/' + $('input[name=hdn_template]').val() + '/dynamic_value',
            type:'POST',
            dataType:'JSON',
            data:{
                "id": $('#hdn_id' + row).val(),
                "_token" : $("input[name=_token]").val(),
            },
            success: function(result)
            {

            },
            complete: function (jqXHR, textStatus)
            {
                $('.js-loading-bar').modal('hide');
                $('.progress-bar').removeClass('animate');
            },
            error: function(xhr, textStatus, thrownError) {
                console.log('Something went to wrong.Please Try again later...' + thrownError);
            }
        });
        
        $('#' + id).slideUp('slow', function () {
            $('#' + id).remove();
            $(this).closest('#' + id).remove();
        });
    });
    
    $("#btn_delete_no").click(function () {        
        id = "";
        row = "";
    });
    
    // upon click, delete the selected row
    $(document).on('click', '.btn_delete', function() {
        id = $(this).closest('div').attr('id');
        row = id.replace("record_", "");

        if ($('#hdn_id' + row).val() != undefined && $('#hdn_id' + row).val() != "") {
            // do nothing
            /*if (confirm("Are you sure you want to delete this record?")) {
                
                var count = $('input[name=hdn_actual_count]').val() - 1;
                $('input[name=hdn_actual_count]').val(count);
            
                 // display animation
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');

                $.ajax({
                    url: $('input[name=base_url]').val() + '/' + $('input[name=hdn_template]').val() + '/dynamic_value',
                    type:'POST',
                    dataType:'JSON',
                    data:{
                        "id": $('#hdn_id' + row).val(),
                        "_token" : $("input[name=_token]").val(),
                    },
                    success: function(result)
                    {

                    },
                    complete: function (jqXHR, textStatus)
                    {
                        $('.js-loading-bar').modal('hide');
                        $('.progress-bar').removeClass('animate');
                    },
                    error: function(xhr, textStatus, thrownError) {
                        console.log('Something went to wrong.Please Try again later...' + thrownError);
                    }
                });
                
                $('#' + id).slideUp('slow', function () {
                    $('#' + id).remove();
                    $(this).closest('#' + id).remove();
                });
            }*/
        } else {
            var count = $('input[name=hdn_actual_count]').val() - 1;
            $('input[name=hdn_actual_count]').val(count);
        
            $('#' + id).slideUp('slow', function () {
                $('#' + id).remove();
                $(this).closest('#' + id).remove();
            });
        }
    });
});

// add a new row of dynamic fields
function addForm() {
    // how many "duplicatable" input fields we currently have
    // var old_count = $('.clonedInput').length;
    var old_count = parseInt($('input[name=hdn_increment]').val());
    // the numeric ID of the new input field being added
    var new_count = new Number(old_count + 1); 
    // create the new element via clone(), and manipulate it's ID using new_count value
    var newElem = $('#record_' + '1').clone().attr('id', 'record_' + new_count).fadeIn('slow').attr("style", "");
    
    // count the number of row added
    $('input[name=hdn_increment]').val(new_count);
    $('input[name=hdn_actual_count]').val(parseInt($('input[name=hdn_actual_count]').val()) + 1);
        
    // setup the properties for addition set of form
    $.each(fields, function(index, value) {
        // flag property 
        newElem.find('[name=hdn_index' + '1' + ']')
            // ID
            .attr('id', 'hdn_index' + new_count)
            // Name
            .attr('name', 'hdn_index' + new_count)
            .val("Y");
            
        // flag property 
        newElem.find('[name=hdn_id' + '1' + ']')
            // ID
            .attr('id', 'hdn_id' + new_count)
            // Name
            .attr('name', 'hdn_id' + new_count)
            .val("");
    
        // button property
        newElem.find('.btn_delete')
            // ID
            .attr('id', 'btn_delete' + new_count)
            // Name
            .attr('name', 'btn_delete' + new_count)
            // Class
            //.attr('class', 'btn btn-danger btn_delete')
            .attr('class', 'btn btn-danger btn-xs btn_delete')
            .attr('data-toggle', '')
            .attr('data-target', '')
            .removeClass('hidden');
    
        // change the label attribute
        newElem.find('.label_' + value.dynamic_type_name + '1');

        if (value.dynamic_input == 'date') {
            // change the input label attribute
            newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'input label_input_' + value.dynamic_type_name + new_count);

            // date property
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // ID
                .attr('id', value.dynamic_type_name + new_count)
                // Name
                .attr('name', value.dynamic_type_name + new_count)
                // Value
                .val(inputs[value.dynamic_type_name + new_count])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count)
                .removeClass('hasDatepicker')
                .removeData('datepicker')
                .unbind()
                .datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });

        } else if (value.dynamic_input == 'text') {
            // change the input label attribute
            newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'input label_input_' + value.dynamic_type_name + new_count);
        
            // text property
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // ID
                .attr('id', value.dynamic_type_name + new_count)
                // Name
                .attr('name', value.dynamic_type_name + new_count)
                // Value
                .val(inputs[value.dynamic_type_name + new_count])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count);
                
        } else if (value.dynamic_input == 'textarea') {
            // change the input label attribute
            newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'textarea label_input_' + value.dynamic_type_name + new_count);
        
            // textarea property
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // ID
                .attr('id', value.dynamic_type_name + new_count)
                // Name
                .attr('name', value.dynamic_type_name + new_count)
                // Value
                .val(inputs[value.dynamic_type_name + new_count])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count);
                

        } else if (value.dynamic_input == 'dropdown' ||
                   value.dynamic_input == 'dropdown_evaluation' ||
                   value.dynamic_input == 'dropdown_assessment' ||
                   value.dynamic_input == 'dropdown_checklist' ||
                   value.dynamic_input == 'dropdown_career_plan' ||
                   value.dynamic_input == 'dropdown_project') {
            // change the select label attribute
            newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'select label_input_' + value.dynamic_type_name + new_count);
            
            // dropdown property                
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // ID
                .attr('id', value.dynamic_type_name + new_count)
                // Name
                .attr('name', value.dynamic_type_name + new_count)
                // Value
                .val(inputs[value.dynamic_type_name + new_count])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count);
                
        } else if (value.dynamic_input == 'radio') {
            // change the radio label attribute
             newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'radio' + $('input[name=ie8]').val() + ' label_input_' + value.dynamic_type_name + new_count);
        
            // radio property
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // Name
                .attr('name', value.dynamic_type_name + new_count)
                // Value
                .val([])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count);
                
        } else if (value.dynamic_input == 'checkbox' || value.dynamic_input == 'checkbox_designation') {
            // change the checkbox label attribute
            newElem.find('.label_input_' + value.dynamic_type_name + '1')
                .attr('class', 'checkbox label_input_' + value.dynamic_type_name + new_count);
        
            // text property
            newElem.find('.input_' + value.dynamic_type_name + '1')
                // Name
                .attr('name', value.dynamic_type_name + new_count + '[]')
                // Value
                .val([])
                // Class
                .attr('class', 'input_' + value.dynamic_type_name + new_count);
        }
        
        // change the error attribute
        newElem.find('.error_input_' + value.dynamic_type_name + '1')
            .attr('class', 'invalid error-msg error_input_' + value.dynamic_type_name + new_count)
            .html('');
    });
 
    // insert the new element after the last "duplicatable" input field
    $("div.clonedInput:last").after(newElem);
}