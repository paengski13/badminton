@extends("module.performance.layout")
@section("performance_content")
    <div class="col-md-10">
        <div class="table-search-v1 panel panel-grey">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="fa fa-list-alt"></i> Appraise Rating</h3>
			<h3 class="panel-title pull-right"><a href="javascript:void(0);" id="modal_description"><i class="fa fa-info"></i></a></h3>
            <div class="clearfix"></div>
        </div>
        
        </div>
        <!--Profile Body-->
        <div class="sky-form">
            <div class="profile-bio">
                <div class="row">
                    <div class="col-md-2">
                        @if (isset($data["employee"]->employee_photo) && $data["employee"]->employee_photo != "")
							<img class="img-responsive md-margin-bottom-10" src="{{ URL::to(UPLOAD_EMPLOYEE_PHOTO_PATH . '/' . $data['employee']->employee_photo) }}" alt="">
                        @else
                            <img class="img-responsive md-margin-bottom-10" src="{{ URL::to('assets/img/employee/no_image.png') }}" alt="">
                        @endif
                    </div>
                    
                    <div class="col-md-10">
                        <!-- Form -->
                        {{ Form::open(array('action' => array('PerformanceController@updateOverallPerformance'), 'files' => true, 'method' => 'POST')) }}
                            @if ($data["employees"]->count())
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Employee</label></section>
                                    <section class="col col-8">
                                        <label class="select">
                                            <select name="employee_rid">
                                                <option value="" disabled selected>Employee</option>
                                                @foreach ($data["employees"] as $record)
                                                    @foreach ($record->employee as $value)
                                                        @if (Input::old('employee_rid') == $value->random_id)
                                                            <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                        @elseif (Input::old('employee_rid') == "" && $data['employee_rid'] == $value->random_id)
                                                            <option value="{{ $value->random_id }}" selected>{{ $value->employee_fullname }}</option>
                                                        @else
                                                            <option value="{{ $value->random_id }}">{{ $value->employee_fullname }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                </div>
                            @endif
                            
                            <div class="row">
                                <section class="col col-3"><label class="label"> Appraisal</label></section>
                                <section class="col col-8">
                                    <label class="select">
                                        <select name="appraisal_rid">
                                            <option value="" selected disabled>Appraisal</option>
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

                            @if (!is_null($data["appraisal"]) && $data["appraisal"]->appraisal_review == 'Y')
                                <div class="row">
                                    <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Overall Performance</label></section>
                                    <section class="col col-8">
                                        <label class="select">
                                            <select name="rating_rid">
                                                <option value="" disabled selected>Overall Performance</option>
                                                @foreach ($data["ratings"] as $value)
                                                    @if (Input::old('rating_rid') == $value->random_id)
                                                        <option value="{{ $value->random_id }}" selected>{{ $value->rating_name }}</option>
                                                    @elseif (Input::old('rating_rid') == "" && isset($data['overall_performance']->rating->random_id) && $data['overall_performance']->rating->random_id == $value->random_id)
                                                        <option value="{{ $value->random_id }}" selected>{{ $value->rating_name }}</option>
                                                    @else
                                                        <option value="{{ $value->random_id }}">{{ $value->rating_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                            {{ $errors->first('rating_rid', '<em for="rating_rid" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Comments</label></section>
                                    <section class="col col-8">
                                        <label class="textarea @if ($errors->has('overall_performance_comment')) state-error @endif">
                                            <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="4" name="overall_performance_comment">{{ (isset($data['overall_performance']->overall_performance_comment)) ? $data['overall_performance']->overall_performance_comment : Input::old('overall_performance_comment') }}</textarea>
                                            {{ $errors->first('overall_performance_comment', '<em for="overall_performance_comment" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>

								@if ($data["appraisal"]->appraisal_status == 'A')
                                <div class="row">
                                    <section class="col col-2">
										<button type="submit" class="btn-u"><i class="fa fa-save"></i> Save</button>
                                    </section>
                                </div>
								@endif
                            @endif
                        {{ Form::close() }}
                        <!-- End Form -->
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
                                    @foreach($performance['value'] as $id => $index)
                                    <tr>
                                        @if ($performance['template_type'] != 'S')
                                            <td><p>{{ $count++ }}</p></td>
                                        @endif
                                        
                                        @foreach($index as $key => $value)
                                            <td><p>{{ nl2br($value) }}</p></td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
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
            <!--End Table Bordered-->
        </div>
        <!--End Profile Body-->
    </div> 
    @include("loading")
    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // Setup
            $('.js-loading-bar').modal({
              backdrop: 'static',
              show: false
            });

            // get the evaluation linked to appraisal
            $('select[name=employee_rid]').change(function () {
                 // display animation
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');
                
                $('select[name=rating_rid]').val("");
                
                populateAppraisal();
                
            });

            // get the evaluation linked to appraisal
            $('select[name=appraisal_rid]').change(function () {
                 // display animation
                $('.js-loading-bar').modal('show');
                $('.progress-bar').addClass('animate');
                
                if ($('select[name=appraisal_rid]').val() != "" && $('select[name=appraisal_rid]').val() != null && $('select[name=employee_rid]').val() != "" && $('select[name=employee_rid]').val() != null) {
                    // add .5 second to load the loading bar properly
                    setTimeout(function (){
                        $('.js-loading-bar').modal('hide');
                        $('.progress-bar').removeClass('animate');

                        window.location.href = $('input[name=base_url]').val() + '/performance/appraisee_detail?appraisal=' + $('select[name=appraisal_rid]').val() + '&employee=' + $('select[name=employee_rid]').val();

                    }, 300);
                    
                }
            });
        });
        
        function populateAppraisal() {
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
                    
                    if ($('select[name=appraisal_rid]').val() != "" && $('select[name=appraisal_rid]').val() != null && $('select[name=employee_rid]').val() != "" && $('select[name=employee_rid]').val() != null) {
                        window.location.href = $('input[name=base_url]').val() + '/performance/appraisee_detail?appraisal=' + $('select[name=appraisal_rid]').val() + '&employee=' + $('select[name=employee_rid]').val();
                    }
                    
                    $('.js-loading-bar').modal('hide');
                    $('.progress-bar').removeClass('animate');
                },
                error: function(xhr, textStatus, thrownError) {
                    console.log('Something went to wrong.Please Try again later...' + thrownError);
                }
            });
        }
    </script>
@stop