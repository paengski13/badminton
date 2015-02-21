@extends("module.performance.layout")
@section("performance_content")
    <!-- Begin Content -->
    <div class="col-md-10">
        <!-- Form -->
        {{ Form::open(array('action' => array('PerformanceController@createForm', $data['template']->template_code), 'class' => 'sky-form', 'files' => true, 'method' => 'POST')) }}
            <!--Table Bordered-->
            <div class="table-search-v1 panel panel-grey">
                <div class="panel-heading">
                    <input type="hidden" name="template_description" value="{{ $data['template']->template_description}}"/>
                    <h3 class="panel-title pull-left"><i class="{{ $data['template']->template_icon}}"></i> {{ $data['template']->template_name }}</h3>
					<h3 class="panel-title pull-right"><a href="javascript:void(0);" id="modal_description"><i class="fa fa-info"></i></a></h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
					@if ($data["employees"]->count())
                    <fieldset>
                        <!-- check if user can submit appraisal on-behalf -->
                        <div class="row">
                            <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Employee</label></section>
                            <section class="col col-9">
                                <label class="select @if ($errors->has('employee_rid')) state-error @endif">
                                    <select name="employee_rid">
                                        <option value="" selected disabled>Employee</option>
                                        <option value="{{ Auth::user()->random_id }}" selected>Myself</option>
                                        @foreach ($data["employees"] as $record)
                                            @foreach ($record->employee as $value)
                                                @if (Input::old('employee_rid') == $value->random_id)
                                                    <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                @elseif (Input::old('employee_rid') == "" && $data["employee_rid"] == $value->random_id)
                                                    <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                @elseif (Session::get('employee_rid') == $value->random_id)
                                                    <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                @else
                                                    <option value="{{ $value->random_id }}">{{ $value->employee_fullname }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <i></i>
                                    {{ $errors->first('employee_rid', '<em for="employee_rid" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div>
                        
                        <!--div class="row">
                            <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Appraisal</label></section>
                            <section class="col col-9">
                                <label class="select @if ($errors->has('appraisal_rid')) state-error @endif">
                                    <select name="appraisal_rid">
                                        <option value="" selected disabled>Appraisal</option>
                                        @foreach ($data["appraisals"] as $value)
                                            @if (Input::old('appraisal_rid') == $value->random_id)
                                                <option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
                                            @elseif (Input::old('appraisal_rid') == "" && $data["appraisal_rid"] == $value->random_id)
                                                <option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
											@elseif ($data["appraisals"]->count() == 1)
												<option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
                                            @else
                                                <option value="{{ $value->random_id }}">{{ $value->appraisal_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <i></i>
                                    {{ $errors->first('appraisal_rid', '<em for="appraisal_rid" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div-->
                    </fieldset>
					@else
					<input type="hidden" name="employee_rid" value="{{ Auth::user()->random_id }}">
					@endif
					
					<input type="hidden" name="appraisal_rid" value="{{ $data['current_appraisal']->random_id }}">
                    
                    <!-- Some template cannot follow the implementation of dynamic template, need to create a unique form -->
                    @if ($data['template']->template_code == "checklist")
                        @include("module.performance.create_checklist_form")
                    @elseif ($data['template']->template_code == "assessment")
                        @include("module.performance.create_assessment_form")
                    @elseif ($data['template']->template_code == "career_aspiration")
                        @include("module.performance.create_career_aspiration_form")
                    @else
                        @include("module.dynamic")
                    @endif
                    
                    <fieldset>
                    @if ($data['template']->template_code == "training")
                        <div class="row">
                            <section class="col col-12"><label class="label"> Do you anticipate any change(s) in the employee’s job function, and if yes, what areas of training would he require to prepare him for the job?</label></section>
                        </div>
                        <div class="row">
                            <section class="col col-11">
                                <label class="textarea @if ($errors->has('performance_training_job_function')) state-error @endif">
                                    <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="4" name="performance_training_job_function">{{ Input::old('performance_training_job_function') }}</textarea>
                                    {{ $errors->first('performance_training_job_function', '<em for="performance_training_job_function" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div>
                    @endif
                    </fieldset>
					
					<table><tr>
					@if (!isset($data['previous_template']->template_code))
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Create & Continue</button></td>
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['next_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-forward"></i> Skip</a></td>
					@elseif (isset($data['next_template']->template_code))
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['previous_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-backward"></i> Back</a></td>
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Create & Continue</button></td>
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['next_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-forward"></i> Skip</a></td>
					@else 
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['previous_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-backward"></i> Back</a></td>
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Create & End</button></td>
						<td>&nbsp;<a href="{{ URL::to('performance/detail') }}" class="btn-u float-shadow"><i class="fa fa-fast-forward"></i> Skip</a></td>
					@endif
					</tr></table>
                </div>
            </div>
            <!--End Table Bordered-->
            
        {{ Form::close() }}
        <!-- End Form -->
        
        @include("loading")
    </div>
    <!-- End Content -->
    
    <input type="hidden" name="hdn_type" value="{{ $data['template']->template_code }}">
			
	<!--[if gte IE 9]><!-->
		<input type="hidden" name="ie8" id="ie8" value="">
	<!--<![endif]-->
	<!--[if IE 8]>
		<input type="hidden" name="ie8" id="ie8" value="_ie8">
	<!--<![endif]-->
    
    <script type="text/javascript">
        jQuery(document).ready(function() {            
            // Setup
            $('.js-loading-bar').modal({
              backdrop: 'static',
              show: false
            });

            // get the employee info
            $('select[name=employee_rid]').change(function () {
                 // display animation
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');
                
                //populateAppraisal();
				getInfo();
            });
            
			/*
            // get the appraisal info
            $('select[name=appraisal_rid]').change(function () {
                 // display animation
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');
                
                getInfo();
            });*/
            
            $('#modal_description').click(function () {
                // display a message to the user
                $('#message_alert').modal('toggle');
                $('#message_alert_label').html('<i class="fa fa-info-circle"> Information</i>');
                $('#message_content').html($('input[name=template_description]').val());
            });
			
			getInfo();
            
        });
        
        function checkAppraisalStatus() {
            $.ajax({
                url: $('input[name=base_url]').val() + '/appraisal/' + $('input[name=appraisal_rid]').val(),
                type: 'get',
                cache: false,
                dataType: 'json',
                success: function (data) {
                    
                },
                complete: function (jqXHR, textStatus){
                    var obj = jQuery.parseJSON(jqXHR.responseText);
                    if (obj['appraisal_status'] == "P") {
                        $("#btn_save").addClass('btn-u-default').prop("disabled", true);
                        
                        // display a message to the user
                        $('#message_alert').modal('toggle');
                        $('#message_alert_label').html('<i class="fa fa-info-circle"> Information</i>');
                        $('#message_content').html(obj['appraisal_name'] + " is currently on-hold. Creation of record for the selected appraisal is not available at the moment. ");
                    } else {
                        $("#btn_save").removeClass('btn-u-default').prop("disabled", false);
                        
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    console.log('Something went to wrong.Please Try again later...' + thrownError);
                }
            });
        }
        
        function getInfo() {
            var employee_rid = "";
            if ($('select[name=employee_rid]').val() != null) {
                employee_rid = $('select[name=employee_rid]').val();
            } else {
                employee_rid = $('input[name=employee_rid]').val();
            }

            if ($('input[name=appraisal_rid]').val() != null) {
                $.ajax({
                    url: $('input[name=base_url]').val() + '/performance/exist/' + $('input[name=hdn_type]').val() + '/' + $('input[name=appraisal_rid]').val() + '/'  + employee_rid,
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        
                    },
                    complete: function (jqXHR, textStatus){
                        var obj = jQuery.parseJSON(jqXHR.responseText);

                        // loop until the record is found
                        $.each (obj, function (key, val) {
                            if (val != "") {
                                window.location.href = $('input[name=base_url]').val() + '/performance/form/' + $('input[name=hdn_type]').val() + '/' + val;
                            }
                        });
                        
                        checkAppraisalStatus();
                    
                        $('.js-loading-bar').modal('hide');
                        $('.progress-bar').removeClass('animate');
                    },
                    error: function(xhr, textStatus, thrownError) {
                        console.log('Something went to wrong.Please Try again later...' + thrownError);
                    }
                });
            }
        }
        
        /*function populateAppraisal() {
            $.ajax({
                url: $('input[name=base_url]').val() + '/performance/employee_appraisal/' + $('select[name=employee_rid]').val(),
                type: 'get',
                cache: false,
                dataType: 'json',
                success: function(data) {
                    
                },
                complete: function (jqXHR, textStatus){
                    var obj = jQuery.parseJSON(jqXHR.responseText);
                    var today = new Date();

                    $("select[name=appraisal_rid]").empty();
                    $("select[name=appraisal_rid]").append('<option value="" selected disabled>Appraisal</option>');
                    
                    $.each (obj, function (key, val) {
                        if (today.getFullYear() == val.appraisal_year && false) {
                            $("select[name=appraisal_rid]").append('<option value="' + val.random_id + '" selected>' + val.appraisal_name + '</option>');
                        } else {
                            $("select[name=appraisal_rid]").append('<option value="' + val.random_id + '">' + val.appraisal_name + '</option>');
                        }
                    });
                    
                    $('.js-loading-bar').modal('hide');
                    $('.progress-bar').removeClass('animate');
                    
                    var employee_rid = "";
                    if ($('select[name=employee_rid]').val() != null) {
                        employee_rid = $('select[name=employee_rid]').val();
                    } else {
                        employee_rid = $('input[name=employee_rid]').val();
                    }
                    
                    window.location.href = $('input[name=base_url]').val() + '/performance/form/' + $('input[name=hdn_type]').val() + '?employee=' + $('select[name=employee_rid]').val();
                },
                error: function(xhr, textStatus, thrownError) {
                    console.log('Something went to wrong.Please Try again later...' + thrownError);
                }
            });
        }*/
    </script>
@stop