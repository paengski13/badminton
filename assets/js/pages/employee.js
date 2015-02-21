$(document).ready(function () {
    // Setup
    $('.js-loading-bar').modal({
      backdrop: 'static',
      show: false
    });

    // get the departments based on selected group
    $('select[name=group_id]').change(function () {
        // display animation
        $('.js-loading-bar').modal('show');
        $('.progress-bar').addClass('animate');
		// get reviewer
		getReviewer();
        
        // get template
        getTemplate();
        
        // get department
        getDepartment();
        
        // get designation
        //getDesignation();
    });
    
	getReviewer();
    getTemplate();
    getDepartment();
	//getDesignation();
});

// call ajax for template
function getTemplate() {
	// get all selected checkboxes
	$.ajax({
		url: $('input[name=base_url]').val() + '/employee/template_access/' + $('input[name=employee_id]').val(),
		type: 'get',
		cache: false,
		dataType: 'json',
		success: function(data) {
			
		},
		complete: function (jqXHR, textStatus){
			obj2 = jQuery.parseJSON(jqXHR.responseText);
			
			// compare it to the current selected group
			$.ajax({
				url: $('input[name=base_url]').val() + '/employee/template_access/' + $('select[name=group_id]').val() + '/performance',
				type: 'get',
				cache: false,
				dataType: 'json',
				success: function(data) {
					
				},
				complete: function (jqXHR, textStatus){
					var obj = jQuery.parseJSON(jqXHR.responseText);
					
					$("#template_access").empty();
					$("#template_access").append('<div class="col col-12">');

					$.each (obj, function (key, val) {
						var check = false;
						
						if (obj2 != null) {
							$.each (obj2, function (key2, val2) {
								if (val.id == val2.template_id) {
									 check = true;
								}
							});
						}

						if (check) {
							if ($('input[name=ie8]').val() == "")
								$("#template_access").append('<label class="checkbox"><input type="checkbox" name="employee_template[]" value="' + val.id + '" checked><i></i>' + val.template_name + '</label>');
							else {
								$("#template_access").append('<label class="checkbox_ie8"><input type="checkbox" name="employee_template[]" value="' + val.id + '" checked><i></i>&nbsp;' + val.template_name + '</label><br/>');
							}
						} else {
							if ($('input[name=ie8]').val() == "")
								$("#template_access").append('<label class="checkbox"><input type="checkbox" name="employee_template[]" value="' + val.id + '"><i></i>' + val.template_name + '</label>');
							else {
								$("#template_access").append('<label class="checkbox_ie8"><input type="checkbox" name="employee_template[]" value="' + val.id + '"><i></i>&nbsp;' + val.template_name + '</label><br/>');
							}
						}
						
					});
					$("#template_access").append('</div>');
				},
				error: function(xhr, textStatus, thrownError) {
					console.log('Something went to wrong.Please Try again later...' + thrownError);
				}
			});
		},
		error: function(xhr, textStatus, thrownError) {
			console.log('Something went to wrong.Please Try again later...' + thrownError);
		}
	});

    
    
}

// call ajax for reviewer
function getReviewer() {
    $.ajax({
        url: $('input[name=base_url]').val() + '/reviewer/' + $('select[name=group_id]').val(),
        type: 'get',
        cache: false,
        dataType: 'json',
        success: function(data) {
            
        },
        complete: function (jqXHR, textStatus){
            var obj = jQuery.parseJSON(jqXHR.responseText);
            
            $('select[name=reviewer_id]').empty();
			$('select[name=reviewer_id]').append('<option value="0" selected disabled>Reviewer</option>');
			
			// iterate reviewer
			$.each (obj, function (key, val) {
				if ($('input[name=text_reviewer_id]').val() == val['id']) {
					$('select[name=reviewer_id]').append('<option value="' + val['id'] + '" selected>' + val['reviewer_name'] + '</option>');
				} else {
					$('select[name=reviewer_id]').append('<option value="' + val['id'] + '">' + val['reviewer_name'] + '</option>');
				}
			});
			
			$('.js-loading-bar').modal('hide');
			$('.progress-bar').removeClass('animate');
        },
        error: function(xhr, textStatus, thrownError) {
            console.log('Something went to wrong.Please Try again later...' + thrownError);
        }
    });
    
}

// call ajax for department
function getDepartment() {
    $.ajax({
        url: $('input[name=base_url]').val() + '/department/' + $('select[name=group_id]').val(),
        type: 'get',
        cache: false,
        dataType: 'json',
        success: function(data) {
            
        },
        complete: function (jqXHR, textStatus){
            var obj = jQuery.parseJSON(jqXHR.responseText);
            
            $('select[name=department_id]').empty();
			$('select[name=department_id]').append('<option value="0" selected disabled>Department</option>');
			
			// iterate department
			$.each (obj, function (key, val) {
				if ($('input[name=text_department_id]').val() == val['id']) {
					$('select[name=department_id]').append('<option value="' + val['id'] + '" selected>' + val['department_name'] + '</option>');
				} else {
					$('select[name=department_id]').append('<option value="' + val['id'] + '">' + val['department_name'] + '</option>');
				}
			});
			
			$('.js-loading-bar').modal('hide');
			$('.progress-bar').removeClass('animate');
        },
        error: function(xhr, textStatus, thrownError) {
            console.log('Something went to wrong.Please Try again later...' + thrownError);
        }
    });
}

// call ajax for designation
function getDesignation() {
    $.ajax({
        url: $('input[name=base_url]').val() + '/designation/' + $('select[name=group_id]').val(),
        type: 'get',
        cache: false,
        dataType: 'json',
        success: function(data) {
            
        },
        complete: function (jqXHR, textStatus){
            var obj = jQuery.parseJSON(jqXHR.responseText);
            
            $('select[name=designation_id1]').empty();
			$('select[name=designation_id1]').append('<option value="0" selected disabled>Designation</option>');
			
			// iterate designation
			$.each (obj, function (key, val) {
				if ($('input[name=text_designation_id]').val() == val['id']) {
					$('select[name=designation_id1]').append('<option value="' + val['id'] + '" selected>' + val['designation_name'] + '</option>');
				} else {
					$('select[name=designation_id1]').append('<option value="' + val['id'] + '">' + val['designation_name'] + '</option>');
				}
			});
			
			$('.js-loading-bar').modal('hide');
			$('.progress-bar').removeClass('animate');
        },
        error: function(xhr, textStatus, thrownError) {
            console.log('Something went to wrong.Please Try again later...' + thrownError);
        }
    });
    
}