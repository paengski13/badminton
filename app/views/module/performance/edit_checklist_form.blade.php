@section("dynamic")
	{? $count = 1; ?}
	<table class="table table-bordered table-hover table-condensed">
		<thead>
			<tr>
				<th width="1%"><p>#</p></th>
				<th class="col-sm-10"><p><i class="fa fa-check-square-o"></i> Checklist</p></th>
				@foreach ($data['designations'] as $designation)
					<th width="1%"><p>{{ $designation->designation_name }}</p></th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($data['dynamic_values'] as $key => $dynamic_value) 
				<tr>
					<td><p>{{ $count }}</p>
						<input type="hidden" name="hdn_index{{ $count }}" id="hdn_index{{ $count }}" value="Y">
						<input type="hidden" name="hdn_id{{ $count }}" id="hdn_id{{ $count }}" value="{{ $dynamic_value->id }}"></td>
					<td><p>
					@foreach($data['checklists'] as $checklist)
						@if ($dynamic_value->int_g == $checklist->id)
							{{ $checklist->checklist_name }}<input type="hidden" name="int_g{{ $count }}" value="{{ $checklist->id }}" >
						@endif
					@endforeach</p></td>
					
					@foreach ($data['designations'] as $designation)
						{? $exist = 0; ?}
						
						@foreach ($data['checklists'][$key]->designation as $value)
							@if ($value->id == $designation->id)
								{? $exist = 1; ?}
								<td><p>
								
								@if (is_array(Input::old('int_h' . $count)) && in_array($designation->id, Input::old('int_h' . $count)))
									<!--[if gte IE 9]><!-->
										<label class="checkbox"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}" checked><i></i></label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="checkbox_ie8"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}" checked><i></i></label>
									<!--<![endif]-->
								@else
									{? $found = 'N' ?}
									@foreach ($dynamic_value->dynamicValueOption as $rec)
										@if ($rec->dynamic_template_option_id == $designation->id)
											<!--[if gte IE 9]><!-->
												<label class="checkbox"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}" checked><i></i></label>
											<!--<![endif]-->
											<!--[if IE 8]>
												<label class="checkbox_ie8"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}" checked><i></i></label>
											<!--<![endif]-->
											{? $found = 'Y' ?}
											@break;
										@endif
									@endforeach
									
									@if ($found == 'N') 
										<!--[if gte IE 9]><!-->
											<label class="checkbox"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}"><i></i></label>
										<!--<![endif]-->
										<!--[if IE 8]>
											<label class="checkbox_ie8"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}"><i></i></label>
										<!--<![endif]-->
									@endif 
								@endif
								</p></td>
								@break
							@endif
						@endforeach
						
						@if ($exist == 0)
							<td><p><i class="fa fa-lock"></i></p></td>
						@endif
					@endforeach
					
				</tr>
				{? $count++; ?}
			@endforeach
		</tbody>
	</table>
	
	<input type="hidden" name="hdn_increment" value="{{ $count }}">
@show