@section("dynamic")
<!-- Dynamic -->
@if(Input::old('hdn_increment'))
    {? $k = Input::old('hdn_increment'); ?}
@else
    {? $k = (1 + $data['dynamic_values']->count()); ?}
@endif

{? $j = 1; ?}
<!--hr class="devider devider-dashed"/-->
@foreach($data['dynamic_values'] as $dynamic_value) 
    <div id="record_{{ $j }}" class="clonedInput">
        <fieldset>
            @foreach ($data['dynamic_fields'] as $key => $record)
                <!-- restricted variables here -->
                @if ($page_title == 'Performance')
                    @if ($record->dynamic_template_access == 'R' || $record->dynamic_template_access == 'PE')
                        @if ($data['performance']->employee_id == Auth::user()->id)
                            @continue;
                        @elseif ($data['appraisal']->appraisal_review == 'N')
                            @continue;
                        @endif
                    @endif
                @endif

                <div class="row">
                    <!-- Label -->
                    <section class="col col-3">
                        <label class="label label_{{ $record->dynamic_type_name . $j }}" title="{{ $record->pivot->dynamic_template_description }}">
                            @if ($record->pivot->dynamic_template_required == $shareView['answer']['yes'])
                                <i class="fa fa-asterisk"></i> 
                            @endif
                            {{ $record->pivot->dynamic_template_name }}
                        </label>
                    </section>

                    <section class="col col-{{ $record->pivot->dynamic_template_size }}">
                    <!-- Date -->
                    @if ($record->dynamic_input == $shareView['date'])
                        <label class="input {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                            <input type="text" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ (Input::old($record->dynamic_type_name . $j)) ? Input::old($record->dynamic_type_name . $j) : date($shareView['date_format_1'], strtotime($dynamic_value->{$record->dynamic_type_name})) }}" class="date input_{{ $record->dynamic_type_name . $j }}">
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Date -->

                    <!-- Text -->
                    @elseif ($record->dynamic_input == $shareView['text'])
						<!-- for Appraisal objectives -->
						
                        <label class="input {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                            <input type="text" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ (Input::old($record->dynamic_type_name . $j)) ? Input::old($record->dynamic_type_name . $j) : $dynamic_value->{$record->dynamic_type_name} }}" class="input_{{ $record->dynamic_type_name . $j }}">
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Text -->

                    <!-- Textarea -->
                    @elseif ($record->dynamic_input == $shareView['textarea'])
                        <label class="textarea {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                            <textarea rows="4" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">{{ (Input::old($record->dynamic_type_name . $j)) ? Input::old($record->dynamic_type_name . $j) : $dynamic_value->{$record->dynamic_type_name} }}</textarea>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>                                        
                    <!-- End Textarea -->
                    
                    <!-- Radio -->
                    @elseif ($record->dynamic_input == $shareView['radio'])
                        <div class="inline-group">
                            @foreach ($data['options'][$key] as $value)
                                @if (Input::old($record->dynamic_type_name . $j) == $value->id)
									<!--[if gte IE 9]><!-->
										<label class="radio {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="radio_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
                                @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
									<!--[if gte IE 9]><!-->
										<label class="radio {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="radio_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
                                @else
									<!--[if gte IE 9]><!-->
										<label class="radio {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
											<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="radio_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
											<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
                                @endif
                            @endforeach
                        </div>
                        <div class="note">
                        {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </div> 
                    <!-- End Radio -->
                    
                    <!-- Checkbox -->
                    @elseif ($record->dynamic_input == $shareView['checkbox'])
                        <div class="inline-group">                                                
                            @foreach ($data['options'][$key] as $value)
                                @if (is_array(Input::old($record->dynamic_type_name . $j)) && in_array($value->id, Input::old($record->dynamic_type_name . $j)))									
									<!--[if gte IE 9]><!-->
										<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
											<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
											<i></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
                                @else
                                    {? $found = 'N' ?}
                                    @foreach ($dynamic_value->dynamicValueOption as $rec)
                                        @if ($rec->dynamic_template_option_id == $value->id)
											<!--[if gte IE 9]><!-->
												<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
													<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
													<i></i>{{ $value->dynamic_template_option_value }}</label>
											<!--<![endif]-->
											<!--[if IE 8]>
												<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
													<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
													<i></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
											<!--<![endif]-->
                                            {? $found = 'Y' ?}
                                            @break;
                                        @endif
                                    @endforeach
                                    
                                    @if ($found == 'N') 
										<!--[if gte IE 9]><!-->
											<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
												<i></i>{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
												<i></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
                                    @endif 
                                @endif
                            @endforeach
                        </div>
                        <div class="note">
                        {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </div>
                        
                        <!-- Designation -->
                        @elseif ($record->dynamic_input == $shareView['checkbox_designation'])
                            <div class="inline-group">
                                @foreach ($data['designations'] as $value)
                                    @if (is_array(Input::old($record->dynamic_type_name . $j)) && in_array($value->id, Input::old($record->dynamic_type_name . $j)))
										<!--[if gte IE 9]><!-->
											<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
												<i></i>{{ $value->designation_name }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
												<i></i>&nbsp;{{ $value->designation_name }}</label>
										<!--<![endif]-->
                                    @else
                                        {? $found = 'N' ?}
                                        @foreach ($dynamic_value->dynamicValueOption as $rec)
                                            @if ($rec->dynamic_template_option_id == $value->id)
												<!--[if gte IE 9]><!-->
													<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
														<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
														<i></i>{{ $value->designation_name }}</label>
												<!--<![endif]-->
												<!--[if IE 8]>
													<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
														<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}" checked>
														<i></i>&nbsp;{{ $value->designation_name }}</label>
												<!--<![endif]-->
                                                {? $found = 'Y' ?}
                                                @break;
                                            @endif
                                        @endforeach
                                        
                                        @if ($found == 'N') 
											<!--[if gte IE 9]><!-->
												<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
													<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
													<i></i>{{ $value->designation_name }}</label>
											<!--<![endif]-->
											<!--[if IE 8]>
												<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
													<input type="checkbox" name="{{ $record->dynamic_type_name . $j }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $j }}">
													<i></i>&nbsp;{{ $value->designation_name }}</label>
											<!--<![endif]-->
                                        @endif 
                                    @endif
                                @endforeach
                            </div>
                            <div class="note">
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$j'>:message</em>") }}
                            </div>
                        <!-- End Designation -->
                        
                    <!-- End Checkbox -->
                    
                    <!-- Dropdown -->
                    @elseif ($record->dynamic_input == $shareView['dropdown'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['options'][$key] as $value)
                                 
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->dynamic_template_option_value }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->dynamic_template_option_value }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->dynamic_template_option_value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                        
                    <!-- Project -->
                    @elseif ($record->dynamic_input == $shareView['dropdown_project'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['projects'] as $value)
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->project_code }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->project_code }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->project_code }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Project -->
                        
                    <!-- Evaluation -->
                    @elseif ($record->dynamic_input == $shareView['dropdown_evaluation'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['evaluations'] as $value)
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->evaluation_name . '  (' . $value->evaluation_from . '% - ' . $value->evaluation_to . '%)' }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->evaluation_name . '  (' . $value->evaluation_from . '% - ' . $value->evaluation_to . '%)' }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->evaluation_name . '  (' . $value->evaluation_from . '% - ' . $value->evaluation_to . '%)' }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Evaluation -->
                        
                    <!-- Assessment -->
                    @elseif ($record->dynamic_input == $shareView['dropdown_assessment'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['assessments'] as $value)
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->assessment_name }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->assessment_name }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->assessment_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Assessment -->
                        
                    <!-- Checklist -->
                    @elseif ($record->dynamic_input == $shareView['dropdown_checklist'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['checklists'] as $value)
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->checklist_name }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->checklist_name }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->checklist_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Checklist -->
                        
                    <!-- Career Plan -->
                    @elseif ($record->dynamic_input == $shareView['dropdown_career_plan'])
                        <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                            <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                 @foreach ($data['career_plans'] as $value)
                                    @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->career_plan_name }}</option>
                                    @elseif (Input::old($record->dynamic_type_name . $j) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
                                        <option value="{{ $value->id }}" selected>{{ $value->career_plan_name }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->career_plan_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <i></i>
                            {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                        </label>
                    <!-- End Career Plan -->
                    
                    <!-- End Dropdown -->
                        
                    @endif
                    </section>
                </div>
            @endforeach
            
            <input type="hidden" name="hdn_index{{ $j }}" id="hdn_index{{ $j }}" value="Y">
            <input type="hidden" name="hdn_id{{ $j }}" id="hdn_id{{ $j }}" value="{{ $dynamic_value->id }}">
            <span class="btn-group navbar-right">
                <p><button type="button" name="btn_delete{{ $j }}" id="btn_delete{{ $j }}" class="open-ConfirmDelete btn btn-danger btn-xs btn_delete @if ($j == 1) hidden @endif" data-toggle="modal" data-target="#confirm_delete"><i class="fa fa-minus-circle"></i> Delete</button></p>
            </span>
        </fieldset>
        
        <hr class="devider devider-dashed"/>
    </div>
    
    {? $j++; ?}
@endforeach

@for ($i = $j + 1; $i <= $k; $i++)
    @if (Input::old('hdn_index'.$i) == 'Y' OR $i == '1')
        <div id="record_{{ $i }}" class="clonedInput">
            <fieldset>
                @foreach ($data['dynamic_fields'] as $key => $record)
                    <!-- restricted variables here -->
                    @if (($record->dynamic_template_access == 'R' || $record->dynamic_template_access == 'PE') && $page_title == 'Performance' && $data['performance']->employee_id == Auth::user()->id)
                        @continue;
                    @endif
                
                    <div class="row">
                        <!-- Label -->
                        <section class="col col-3">
                            <label class="label label_{{ $record->dynamic_type_name . $i }}" title="{{ $record->pivot->dynamic_template_description }}">
                                @if ($record->pivot->dynamic_template_required == $shareView['answer']['yes'])
                                    <i class="fa fa-asterisk"></i> 
                                @endif
                                {{ $record->pivot->dynamic_template_name }}
                            </label>
                        </section>
                        
                        <section class="col col-{{ $record->pivot->dynamic_template_size }}">
                        <!-- Date -->
                        @if ($record->dynamic_input == $shareView['date'])
                            <label class="input {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                                <input type="text" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ Input::old($record->dynamic_type_name . $i) }}" class="date input_{{ $record->dynamic_type_name . $i }}">
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Date -->

                        <!-- Text -->
                        @elseif ($record->dynamic_input == $shareView['text'])
                            <label class="input {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                                <input type="text" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ Input::old($record->dynamic_type_name . $i) }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Text -->

                        <!-- Textarea -->
                        @elseif ($record->dynamic_input == $shareView['textarea'])
                            <label class="textarea {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
                                <textarea rows="4" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">{{ Input::old($record->dynamic_type_name . $i) }}</textarea>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>                                        
                        <!-- End Textarea -->
                        
                        <!-- Radio -->
                        @elseif ($record->dynamic_input == $shareView['radio'])
                            <div class="inline-group">
                                @foreach ($data['options'][$key] as $value)
                                    @if (Input::old($record->dynamic_type_name . $i) == $value->id)
										<!--[if gte IE 9]><!-->
											<label class="radio {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="radio" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}" checked>
												<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="radio_ie8 {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="radio" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}" checked>
												<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
                                    @else
										<!--[if gte IE 9]><!-->
											<label class="radio {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="radio" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}">
												<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="radio_ie8 {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="radio" id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}">
												<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
                                    @endif
                                @endforeach
                            </div>
                            <div class="note">
                            {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </div> 
                        <!-- End Radio -->
                        
                        <!-- Checkbox -->
                        @elseif ($record->dynamic_input == $shareView['checkbox'])
                            <div class="inline-group">                                                
                                @foreach ($data['options'][$key] as $value)
                                    @if (is_array(Input::old($record->dynamic_type_name . $i)) && in_array($value->id, Input::old($record->dynamic_type_name . $i)))
										<!--[if gte IE 9]><!-->
											<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}" checked>
												<i></i>{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}" checked>
												<i></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
                                    @else
										<!--[if gte IE 9]><!-->
											<label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}">
												<i></i>{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="checkbox_ie8 {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
												<input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}">
												<i></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
										<!--<![endif]-->
                                    @endif
                                @endforeach
                            </div>
                            <div class="note">
                            {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </div>
                        <!-- End Checkbox -->
                        
                        <!-- Dropdown -->
                        @elseif ($record->dynamic_input == $shareView['dropdown'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['options'][$key] as $value)
                                     
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->dynamic_template_option_value }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->dynamic_template_option_value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                            
                        <!-- Project -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_project'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['projects'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->project_code }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->project_code }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Project -->
                            
                        <!-- Evaluation -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_evaluation'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['evaluations'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->evaluation_name . '  (' . $value->evaluation_from . '% - ' . $value->evaluation_to . '%)' }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->evaluation_name . '  (' . $value->evaluation_from . '% - ' . $value->evaluation_to . '%)' }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                            </label>
                        <!-- End Evaluation -->
                            
                        <!-- Assessment -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_assessment'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $j }} @if ($errors->has($record->dynamic_type_name . $j)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $j }}" name="{{ $record->dynamic_type_name . $j }}" class="input_{{ $record->dynamic_type_name . $j }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['assessments'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $j) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->assessment_name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->assessment_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $j, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $j'>:message</em>") }}
                            </label>
                        <!-- End Assessment -->
                        
                        <!-- Checklist -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_checklist'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['checklists'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->checklist_name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->checklist_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Checklist -->
                        
                        <!-- Career Plan -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_career_plan'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['career_plans'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->career_plan_name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->career_plan_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Career Plan -->
                        
                        @endif
                        <!-- End Dropdown -->
                        </section>
                    </div>
                @endforeach
                
                <input type="hidden" name="hdn_index{{ $i }}" id="hdn_index{{ $i }}" value="Y">
                <span class="btn-group navbar-right">
                    <button type="button" name="btn_delete{{ $i }}" id="btn_delete{{ $i }}" class="btn btn-danger btn-xs btn_delete @if ($i == 1) hidden @endif "><i class="fa fa-minus-circle"></i> Delete</button>   
                </span>
            </fieldset>
            
            <hr class="devider devider-dashed"/>
        </div>
    @endif
@endfor

@if ($data['template']->template_type == $shareView['template_type']['multiple'])
    <button type="button" id="btn_add" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> Add Row</button>
@endif

<input type="hidden" name="hdn_actual_count" value="{{ (Input::old('hdn_actual_count')) ? Input::old('hdn_actual_count') : 1 }}">
<input type="hidden" name="hdn_increment" value="{{ (Input::old('hdn_increment')) ? Input::old('hdn_increment') : $k }}">

<!-- Delete Confirmation -->
<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p>Delete this record?</p>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_delete_no" class="btn-u btn-u-default" data-dismiss="modal"><i class="fa fa-thumbs-down"></i> No</button>
				<button type="button" id="btn_delete_yes" class="btn-u" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Yes</button>
			</div>
		</div>
	</div>
</div>
<!-- End Delete Confirmation -->

<script type="text/javascript">
    var fields = {{ json_encode($data['dynamic_fields']) }};
    var inputs = {{ json_encode(Input::old()) }};
</script>
<!-- End Dynamic -->
@show