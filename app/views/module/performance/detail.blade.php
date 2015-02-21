@extends("module.performance.layout")
@section("performance_content")
    <!--=== Profile ===-->
    <div class="profile">	
        <div class="col-md-10">
            <!--Profile Body-->
            <div class="profile-body">
                <div class="profile-bio">
                    <div class="row">
                        <div class="col-md-2">
                            @if (isset($data["employee"]->employee_photo) && $data["employee"]->employee_photo != "")
								<img class="img-responsive md-margin-bottom-10" src="{{ URL::to(UPLOAD_EMPLOYEE_PHOTO_PATH . '/' . $data['employee']->employee_photo) }}" alt="">
							@else
								<img class="img-responsive md-margin-bottom-10" src="{{ URL::to('assets/img/employee/no_image.png') }}" alt="">
							@endif
                        </div>
                        <div class="col-md-10" class="sky-form">
                            <h2>{{ $data["employee"]->employee_fullname }}</h2>
                            <span class="font12"><strong>Position:</strong> {{ $data["employee"]->employee_position }}</span>
							{{ Form::open(array('action' => array('PerformanceController@createForm'), 'class' => 'sky-form', 'files' => true, 'method' => 'POST')) }}
                                <div class="row">
                                    <section class="col col-2"><label class="label"> Appraisal</label></section>
                                    <section class="col col-10">
                                        <label class="select">
                                            <select name="appraisal_rid">
                                                <option value="0" selected disabled>Appraisal</option>
                                                @foreach ($data["appraisals"] as $value)
                                                    @if (Input::old('appraisal_rid') == $value->random_id)
                                                        <option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
                                                    @elseif (Input::old('appraisal_rid') == "" && $data['appraisal_rid'] == $value->random_id)
                                                        <option value="{{ $value->random_id }}" selected>{{ $value->appraisal_name }}</option>
                                                    @else
                                                        <option value="{{ $value->random_id }}">{{ $value->appraisal_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
								</div>
								
								<div class="row">
									<section class="col col-2"><label class="label"> Job Description</label></section>
                                    @if ($data['employee']->employee_job_description_old != "")
                                    <section class="col col-4">
                                        <a href="{{ URL::to('employee/download/job_description/' .  $data['employee']->random_id) }}" target="_blank" class="btn-u rounded btn-u-default btn-u-xs"><i class="fa fa-download"></i> {{ $data['employee']->employee_job_description_old }}</a>
                                    </section>
                                    @endif
								</div>
								
								<div class="row">
									@if (isset($data['overall_performance']))
										<section class="col col-2"><label class="label"> Potential Rating</label></section>
										<section class="col col-10">
											<strong><a href="javascript:void(0);" id="modal_description" class="btn btn-warning btn-xs">{{ $data['overall_performance']->rating->rating_name }}</a></strong>
											<input type="hidden" name="template_description" value="{{ $data['overall_performance']->rating->rating_description }}"/>
										</section>
									@endif
                                </div>
							{{ Form::close() }}
                        </div>
                    </div>    
                </div>
                @if ($data['result'])
                    @foreach ($data['performances'] as $performance)
                        <div class="table-search-v1 panel panel-grey">
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left"><i class="{{ $performance['template_icon'] }}"></i> {{ $performance['template_name'] }}</h3>
                                <div class="clearfix"></div>
                            </div>
							
							<div class="panel-body sky-form">
							@if ($performance['template_code'] == "checklist")
								<table class="table table-bordered table-hover table-condensed">
									<thead>
										<tr>
											@if ($performance['template_type'] != 'S')
												<th width="1%"><p>#</p></th>
											@endif
											
											@foreach($performance['field'] as $key => $header)
												<th class="col-sm-{{ $header['size'] }}"><p>{{ $key }}</p></th>
											@endforeach
										</tr>
									</thead>
									{? $count = 1 ?}
									<tbody>
										@foreach($performance['value'] as $key => $index)
										<tr>
											@if ($performance['template_type'] != 'S')
												<td><p>{{ $count++ }}</p></td>
											@endif
											
											@foreach($index as $key2 => $value)
												<td><p>
												@if ($performance['access'][$key][$key2] == "PE" && $data['appraisal']->appraisal_reveal == "N")
													--
												@else
													{{ nl2br($value) }}
												@endif</p></td>
											@endforeach
										</tr>
										@endforeach
									</tbody>
								</table>
							@else
								<table class="table table-bordered table-hover table-condensed">
									<thead>
										<tr>
											@if ($performance['template_type'] != 'S')
												<th width="1%"><p>#</p></th>
											@endif
											
											@foreach($performance['field'] as $key => $header)
												<th class="col-sm-{{ $header['size'] }}"><p>{{ $key }}</p></th>
											@endforeach
										</tr>
									</thead>
									{? $count = 1 ?}
									<tbody>
										@foreach($performance['value'] as $key => $index)
										<tr>
											@if ($performance['template_type'] != 'S')
												<td><p>{{ $count++ }}</p></td>
											@endif
											
											@foreach($index as $key2 => $value)
												<td><p>
												@if ($performance['access'][$key][$key2] == "PE" && $data['appraisal']->appraisal_reveal == "N")
													--
												@else
													{{ nl2br($value) }}
												@endif</p></td>
											@endforeach
										</tr>
										@endforeach
									</tbody>
								</table>
							@endif
							@if ($performance['template_code'] == 'training')
								<fieldset>
									<div class="row">
										<section class="col col-12"><label class="label">Do you anticipate any change(s) in the employee’s job function, and if yes, what areas of training would he require to prepare him for the job? <strong> {{ $performance['record']->performance_training_job_function }}</strong></label></section>
									</div>
								</fieldset>
							@endif
							
							</div>
                        </div>
                    @endforeach
                @else
                    <div class="table-search-v1 panel panel-grey">
                        <table class="table table-bordered table-hover table-condensed">
                            <tr>
                                <td class="text-center">No Record Found</td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
            <!--End Profile Body-->
        </div> 
        @include("loading")
    </div>		
    <!--=== End Profile ===-->
    
    <script type="text/javascript">
        jQuery(document).ready(function() {            
            // Setup
            $('.js-loading-bar').modal({
              backdrop: 'static',
              show: false
            });

            // get the evaluation linked to appraisal
            $('select[name=appraisal_rid]').change(function () {
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');
                // add .5 second to load the loading bar properly
                setTimeout(function (){
                    $('.js-loading-bar').modal('hide');
                    $('.progress-bar').removeClass('animate');

                     window.location.href = $('input[name=base_url]').val() + '/performance/detail?appraisal=' + $('select[name=appraisal_rid]').val();

                }, 500);
            });
			
			// get the description of the overall potential rating
			$('#modal_description').click(function () {
                // display a message to the user
                $('#message_alert').modal('toggle');
                $('#message_alert_label').html('<i class="fa fa-info-circle"> Information</i>');
                $('#message_content').html($('input[name=template_description]').val());
            });
        });
    </script>
@stop