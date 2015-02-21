@extends("module.local.layout")
@section("local_content")
    <!-- Begin Content -->
    <div class="col-md-9">
        <!-- Form -->
        {{ Form::open(array('action' => array('LocalController@createForm', $data['template']['template_code']), 'class' => 'sky-form', 'files' => true, 'method' => 'PUT')) }}
            <div class="shadow-wrapper">
                <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                    <h2>
                        <i class="{{ $data['template']['template_icon'] }}"> {{ $data['template']['template_name'] }}</i>
                    </h2>
                    
                    @if(Input::old('hdn_increment'))
                        {? $k = Input::old('hdn_increment'); ?}
                    @else
                        {? $k = 1; ?}
                    @endif
                    
                    @for ($i = 1; $i <= $k; $i++)
                        @if (Input::old('hdn_index'.$i) == 'Y' OR $i == '1')
                            <div id="record_{{ $i }}" class="clonedInput">
                                <fieldset>
                                    @foreach($data['dynamic_fields'] as $key => $field)
                                    
                                    <div class="row">
                                        <section class="col col-2">
                                            <label class="label label_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" for="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                @if ($field['pivot']['template_dynamic_html_required'] == $shareView['answer']['yes'])
                                                    <i class="fa fa-asterisk"></i> 
                                                @endif
                                                {{ $field['pivot']['template_dynamic_html_name'] }}
                                            </label>
                                        </section>
                                        
                                        <section class="col col-{{ $field['pivot']['template_dynamic_html_size'] }}">
                                            @if ($field['dynamic_field_input'] == $shareView['date'])
                                                <label class="input {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                    <i class="icon-append {{ $field['pivot']['template_dynamic_html_icon'] }}"></i>
                                                    <input type="text" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                                       id="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                                       value="{{ Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i) }}" 
                                                                       class="date input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                    {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                    
                                                </label>
                                                
                                            @elseif ($field['dynamic_field_input'] == $shareView['text'])
                                                <label class="input {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                    <i class="icon-append {{ $field['pivot']['template_dynamic_html_icon'] }}"></i>
                                                    <input type="text" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                                       id="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}"
                                                                       value="{{ Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i) }}" 
                                                                       class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                    {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                </label>
                                                
                                            @elseif ($field['dynamic_field_input'] == $shareView['dropdown'])
                                                <label class="select {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                    <select name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}"
                                                            id="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}"
                                                            class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                        <option value="" selected>{{ $field['pivot']['template_dynamic_html_name'] }}</option>
                                                         @foreach ($data['options'][$key] as $value)
                                                         
                                                            @if (Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i) == $value['template_dynamic_option_id'])
                                                                <option value="{{ $value['template_dynamic_option_id'] }}" selected>{{ $value['template_dynamic_option_value'] }}</option>
                                                            @else
                                                                <option value="{{ $value['template_dynamic_option_id'] }}">{{ $value['template_dynamic_option_value'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                    {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                </label>
                                                
                                            @elseif ($field['dynamic_field_input'] == $shareView['radio'])
                                                <div class="inline-group">
                                                    @foreach ($data['options'][$key] as $value)
                                                        @if (Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i) == $value['template_dynamic_option_id'])
                                                            <label class="radio {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                                <input type="radio" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                                       value="{{ $value['template_dynamic_option_id'] }}"
                                                                       class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" checked>
                                                                <i class="rounded-x"></i>{{ $value['template_dynamic_option_value'] }}</label>
                                                        @else
                                                            <label class="radio {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                                <input type="radio" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                                       value="{{ $value['template_dynamic_option_id'] }}"
                                                                       class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                                <i class="rounded-x"></i>{{ $value['template_dynamic_option_value'] }}</label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="note">
                                                {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                </div>  
                                                
                                            @elseif ($field['dynamic_field_input'] == $shareView['checkbox'])
                                                <div class="inline-group">                                                
                                                    @foreach ($data['options'][$key] as $index => $value)
                                                         
                                                        @if (is_array(Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i)) && in_array($value['template_dynamic_option_id'], Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i)))
                                                            <label class="checkbox {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                                <input type="checkbox" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}[]" 
                                                                       value="{{ $value['template_dynamic_option_id'] }}"
                                                                       class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" checked>
                                                                <i></i>{{ $value['template_dynamic_option_value'] }}</label>
                                                        @else
                                                            <label class="checkbox {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i)) state-error @endif">
                                                                <input type="checkbox" name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}[]" 
                                                                       value="{{ $value['template_dynamic_option_id'] }}"
                                                                       class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                                <i></i>{{ $value['template_dynamic_option_value'] }}</label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="note">
                                                {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                </div>   
                                                
                                            @elseif ($field->dynamic_field_input == $shareView['dropdown_project'])
                                                <label class="select {{ 'xinput_local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i }} @if ($errors->has('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'].$i)) state-error @endif">
                                                    <select name="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}" 
                                                            id="local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}"
                                                            class="input_local_expense_{{ $field['dynamic_field_type'] }}_{{ $field['dynamic_field_name'] . $i }}">
                                                        <option value="" selected>{{ $field['pivot']['template_dynamic_html_name'] }}</option>
                                                         @foreach ($data['projects'] as $value)
                                                            @if (Input::old('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i) == $value['project_id'])
                                                                <option value="{{ $value['project_id'] }}" selected>{{ $value['project_code'] }}</option>
                                                            @else
                                                                <option value="{{ $value['project_id'] }}">{{ $value['project_code'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                    {{ $errors->first('local_expense_'.$field['dynamic_field_type'].'_'.$field['dynamic_field_name'] . $i, "<em class='invalid error-msg minput_local_expense_".$field['dynamic_field_type']."_".$field['dynamic_field_name']."$i'>:message</em>") }}
                                                </label>
                                                
                                            @endif
                                        </section>
                                    </div>
                                    @endforeach
                                    
                                    <input type="hidden" name="hdn_index{{ $i }}" id="hdn_index{{ $i }}" value="Y">
                                    <span class="btn-group navbar-right">
                                        <button type="button" name="btn_delete{{ $i }}" id="btn_delete{{ $i }}" class="btn btn-danger btn_delete hidden"><i class="fa fa-minus"></i> Delete Row</button>   
                                    </span>
                                </fieldset>
                                <hr class="devider devider-dashed"/>
                            </div>
                        @endif
                    @endfor

                    <input type="hidden" name="hdn_actual_count" value="{{ (Input::old('hdn_actual_count')) ? Input::old('hdn_actual_count') : 1 }}">
                    <input type="hidden" name="hdn_increment" value="{{ (Input::old('hdn_increment')) ? Input::old('hdn_increment') : 1 }}">
                    
                    <button type="button" id="btn_add" class="btn-u"><i class="fa fa-plus"></i> Add Row</button>
                    <button type="submit" class="btn-u"><i class="fa fa-save"></i> Save as draft</button>
                    <button type="button" class="open-ConfirmDelete btn-u" data-toggle="modal" data-target="#confirm_submit"><i class="fa fa-paper-plane"></i> Submit</button>
                </div>
            </div>
            
            @include("confirmation.claim_submission")
            
        {{ Form::close() }}
        <!-- End Form -->
    </div>                
    <!-- End Content -->
                
    <script type="text/javascript">
        var fields = {{ json_encode($data['dynamic_fields']) }};
        var inputs = {{ json_encode(Input::old()) }};
    </script>
@stop