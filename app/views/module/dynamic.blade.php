@section("dynamic")
<!-- Dynamic -->
@if(Input::old('hdn_increment'))
    {? $k = Input::old('hdn_increment'); ?}
@else
    {? $k = 1; ?}
@endif

@for ($i = 1; $i <= $k; $i++)
    @if (Input::old('hdn_index'.$i) == 'Y' OR $i == '1')
        <div id="record_{{ $i }}" class="clonedInput">
            <fieldset>
                @foreach ($data['dynamic_fields'] as $key => $record)
                    <!-- restricted variables here -->
                    @if (($record->dynamic_template_access == 'R' || $record->dynamic_template_access == 'PE') && $page_title == 'Performance')
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
                            
                            <!-- Designation -->
                            @elseif ($record->dynamic_input == $shareView['checkbox_designation'])
                                <div class="inline-group">      
                                    @foreach ($data['designations'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                                <input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}" checked>
                                                <i></i>{{ $value->designation_name }}</label>
                                        @else
                                            <label class="checkbox {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                                <input type="checkbox" name="{{ $record->dynamic_type_name . $i }}[]" value="{{ $value->id }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                                <i></i>{{ $value->designation_name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="note">
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                                </div>
                            <!-- End Designation -->
                        
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
                                </select><a href="javascript:void(0);" id="modal_descriptions"><i class="fa fa-info"></i></a>
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
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['evaluations'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->evaluation_name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->evaluation_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
                            </label>
                        <!-- End Evaluation -->
                        
                        <!-- Assessment -->
                        @elseif ($record->dynamic_input == $shareView['dropdown_assessment'])
                            <label class="select {{ 'label_input_' . $record->dynamic_type_name . $i }} @if ($errors->has($record->dynamic_type_name . $i)) state-error @endif">
                                <select id="{{ $record->dynamic_type_name . $i }}" name="{{ $record->dynamic_type_name . $i }}" class="input_{{ $record->dynamic_type_name . $i }}">
                                    <option value="" selected>{{ $record->pivot->dynamic_template_name }}</option>
                                     @foreach ($data['assessments'] as $value)
                                        @if (Input::old($record->dynamic_type_name . $i) == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->assessment_name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->assessment_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                {{ $errors->first($record->dynamic_type_name . $i, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . "$i'>:message</em>") }}
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
                        
                        <!-- End Dropdown -->
                            
                        @endif
                        </section>
						
						<!--section class="col col-1">
							<a href="javascript:void(0);" id="field_description"><i class="fa fa-info-circle"></i></a>
						</section-->
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
<input type="hidden" name="hdn_increment" value="{{ (Input::old('hdn_increment')) ? Input::old('hdn_increment') : 1 }}">

<script type="text/javascript">
    var fields = {{ json_encode($data['dynamic_fields']) }};
    var inputs = {{ json_encode(Input::old()) }};
</script>
<!-- End Dynamic -->
@show