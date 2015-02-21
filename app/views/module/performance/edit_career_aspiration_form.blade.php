@section("dynamic")
	{? $count = 1; ?}
	<table class="table table-bordered table-hover table-condensed">
		<thead>
			<tr>
				<th width="1%"><p>#</p></th>
				<th class="col-sm-2"><p><i class="fa fa-binoculars"></i> Career Plan</p></th>
				<th class="col-sm-2"><p> Develop in current position</p></th>
				<th class="col-sm-3"><p> Change current position to other position/function</p></th>
				<th class="col-sm-5"><p> Specify if Yes</p></th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['dynamic_values'] as $dynamic_value) 
				<tr>
					<td><p>{{ $count }}</p>
						<input type="hidden" name="hdn_index{{ $count }}" id="hdn_index{{ $count }}" value="Y">
						<input type="hidden" name="hdn_id{{ $count }}" id="hdn_id{{ $count }}" value="{{ $dynamic_value->id }}"></td>
					<td><p>
					@foreach($data['career_plans'] as $key => $career_plan)
						@if ($dynamic_value->int_i == $career_plan->id)
							{{ $career_plan->career_plan_name }}<input type="hidden" name="int_i{{ $count }}" value="{{ $career_plan->id }}" >
						@endif
					@endforeach</p></td>
					@foreach ($data['dynamic_fields'] as $key => $record)
						@if ($record->dynamic_input == $shareView['radio'])
							<td><div class="inline-group">
								@foreach ($data['options'][$key] as $value)
								@if (Input::old($record->dynamic_type_name . $count) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
									<!--[if gte IE 9]><!-->
										<label class="radio @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}" value="{{ $value->id }}" checked>
											<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="radio_ie8 @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}" value="{{ $value->id }}" checked>
											<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
								@else
									<!--[if gte IE 9]><!-->
										<label class="radio @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}" value="{{ $value->id }}">
											<i class="rounded-x"></i>{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="radio_ie8 @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
											<input type="radio" id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}" value="{{ $value->id }}">
											<i class="rounded-x"></i>&nbsp;{{ $value->dynamic_template_option_value }}</label>
									<!--<![endif]-->
								@endif
								@endforeach	
							</div></td>
						
						@elseif ($record->dynamic_input == $shareView['dropdown'])
							<td>
								<label class="select @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
									<select id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}">
										 @foreach ($data['options'][$key] as $value)
											@if (Input::old($record->dynamic_type_name . $count) == "" && $dynamic_value->{$record->dynamic_type_name} == $value->id)
												<option value="{{ $value->id }}" selected>{{ $value->dynamic_template_option_value }}</option>
											@else
												<option value="{{ $value->id }}">{{ $value->dynamic_template_option_value }}</option>
											@endif
										@endforeach
									</select>
									<i></i>
								</label>
							</td>
							
                        @elseif ($record->dynamic_input == $shareView['textarea'])
							<td>
								<label class="textarea {{ 'label_input_' . $record->dynamic_type_name . $count }} @if ($errors->has($record->dynamic_type_name . $count)) state-error @endif">
									<i class="icon-append {{ $record->pivot->dynamic_template_icon }}"></i>
									<textarea rows="4" id="{{ $record->dynamic_type_name . $count }}" name="{{ $record->dynamic_type_name . $count }}" class="input_{{ $record->dynamic_type_name . $count }}">{{ (Input::old($record->dynamic_type_name . $count)) ? Input::old($record->dynamic_type_name . $count) : $dynamic_value->{$record->dynamic_type_name} }}</textarea>
									{{ $errors->first($record->dynamic_type_name . $count, "<em class='invalid error-msg error_input_" . $record->dynamic_type_name . " $count'>:message</em>") }}
								</label>   
							</td>
						@endif
						
					@endforeach
				</tr>
				{? $count++; ?}
			@endforeach
		</tbody>
	</table>
	
	<input type="hidden" name="hdn_increment" value="{{ $count }}">
@show