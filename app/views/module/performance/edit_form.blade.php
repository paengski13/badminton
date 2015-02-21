@extends("module.performance.layout")
@section("performance_content")
    <!-- Begin Content -->
    <div class="col-md-10">
        
        <!-- Form -->
        {{ Form::open(array('action' => array('PerformanceController@editForm', $data['template']->template_code, $data['performance']->random_id), 'class' => 'sky-form', 'files' => true, 'method' => 'POST')) }}
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
                                        <option value="0" selected disabled>Employee</option>
                                        @if (Auth::user()->random_id == $data['performance']->employee->random_id)
                                            <option value="{{ Auth::user()->random_id }}" selected>Myself</option>
                                        @else
                                            <option value="{{ Auth::user()->random_id }}">Myself</option>
                                        @endif
                                        
                                        @foreach ($data["employees"] as $record)
                                            @foreach ($record->employee as $value)
                                                @if (Input::old('employee_rid') == $value->random_id)
                                                    <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                @elseif (Input::old('employee_rid') == "" && $data['performance']->employee->random_id == $value->random_id)
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
                                        <option value="0" selected disabled>Appraisal</option>
                                        @foreach ($data["appraisals"] as $value)
                                            @if (Input::old('appraisal_rid') == $value->random_id)
                                                <option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
                                            @elseif (Input::old('appraisal_rid') == "" && $data['performance']->appraisal->random_id == $value->random_id)
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
					
					<input type="hidden" name="appraisal_rid" value="{{ $data['performance']->appraisal->random_id }}">
					
                    <!-- Some template cannot follow the implementation of dynamic template, need to create a unique form -->
                    @if ($data['template']->template_code == "checklist")
                        @include("module.performance.edit_checklist_form")
                    @elseif ($data['template']->template_code == "assessment")
                        @include("module.performance.edit_assessment_form")
                    @elseif ($data['template']->template_code == "career_aspiration")
                        @include("module.performance.edit_career_aspiration_form")
					@elseif ($data['template']->template_code == "objective")
                        @include("module.edit_dynamic")
                    @else
                        @include("module.edit_dynamic")
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
                                    <textarea rows="4" name="performance_training_job_function">{{ (Input::old('performance_training_job_function')) ? Input::old('performance_training_job_function') : $data['performance']->performance_training_job_function }}</textarea>
                                    {{ $errors->first('performance_training_job_function', '<em for="performance_training_job_function" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div>
                    @endif
                    </fieldset>
                
					<table><tr>
					@if (!isset($data['previous_template']->template_code))
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Update & Continue</button></td>
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['next_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-forward"></i> Skip</a></td>
					@elseif (isset($data['next_template']->template_code))
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['previous_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-backward"></i> Back</a></td>
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Update & Continue</button></td>
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['next_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-forward"></i> Skip</a></td>
					@else 
						<td>&nbsp;<a href="{{ URL::to('performance/form/' . $data['previous_template']->template_code) }}" class="btn-u float-shadow"><i class="fa fa-fast-backward"></i> Back</a></td>
						<td>&nbsp;<button type="submit" class="btn-u float-shadow" id="btn_save"><i class="fa fa-save"></i> Update & End</button></td>
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
    <input type="hidden" name="hdn_template" value="performance">
    
    <input type="hidden" name="hdn_template_code" value="{{ $data['template']->template_code }}">
	
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
                getInfo();
            });

            // get the appraisal info
            /*$('input[name=appraisal_rid]').change(function () {
                getInfo();
            });*/
            
            $('#modal_description').click(function () {
                // display a message to the user
                $('#message_alert').modal('toggle');
                $('#message_alert_label').html('<i class="fa fa-info-circle"> Information</i>');
                $('#message_content').html($('input[name=template_description]').val());
            });
            
            checkAppraisalStatus();
        });
        
        function getInfo() {
             // display animation
            $('.js-loading-bar').modal('show');
            $('.progress-bar').addClass('animate');
            $.ajax({
                url: $('input[name=base_url]').val() + '/performance/exist/' + $('input[name=hdn_type]').val() + '/' + $('input[name=appraisal_rid]').val() + '/'  + $('select[name=employee_rid]').val(),
                type: 'get',
                cache: false,
                dataType: 'json',
                success: function(data) {
                    
                },
                complete: function (jqXHR, textStatus){
                    var obj = jQuery.parseJSON(jqXHR.responseText);
                    var val = obj.id;                    
                    
                    if (obj.id != "" && obj.id != undefined) {
                        window.location.href = $('input[name=base_url]').val() + '/performance/form/' + $('input[name=hdn_type]').val() + '/' + val;
                    } else { 
                        window.location.href = $('input[name=base_url]').val() + '/performance/form/' + $('input[name=hdn_type]').val() + '?appraisal=' + $('input[name=appraisal_rid]').val() + '&employee=' + $('select[name=employee_rid]').val();
                    }
                    
                    $('.js-loading-bar').modal('hide');
                    $('.progress-bar').removeClass('animate');
                },
                error: function(xhr, textStatus, thrownError) {
                    console.log('Something went to wrong.Please Try again later...' + thrownError);
                }
            });
        }
        
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
                        $('#message_content').html(obj['appraisal_name'] + " is currently on-hold. Update of record for the selected appraisal is not available at the moment. ");
                    } else {
                        $("#btn_save").removeClass('btn-u-default').prop("disabled", false);
                        
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    console.log('Something went to wrong.Please Try again later...' + thrownError);
                }
            });
        }
    </script>
@stop