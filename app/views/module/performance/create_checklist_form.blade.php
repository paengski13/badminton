@section("dynamic")
	{? $count = 1; ?}
	<table class="table table-bordered table-hover table-condensed">
		<thead>
			<tr>
				<th width="1%"><p>#</p></th>
				<th class="col-sm-8"><p><i class="fa fa-check-square-o"></i> Checklist</p></th>
				@foreach ($data['designations'] as $designation)
					<th width="1%"><p>{{ $designation->designation_name }}</p></th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach ($data['checklists'] as $key => $checklist)
				<tr>
					<td><p>{{ $count++ }}</p>
						<input type="hidden" name="hdn_index{{ $count }}" id="hdn_index{{ $count }}" value="Y"></td>
					<td><p>{{ $checklist->checklist_name }}<input type="hidden" name="int_g{{ $count }}" value="{{ $checklist->id }}" ></p></td>
					
					@foreach ($data['designations'] as $designation)
						{? $exist = 0; ?}
						
						@foreach ($checklist->designation as $value)
							@if ($value->id == $designation->id)
								{? $exist = 1; ?}
								<td><p>
									<!--[if gte IE 9]><!-->
										<label class="checkbox"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}"><i></i></label>
									<!--<![endif]-->
									<!--[if IE 8]>
										<label class="checkbox_ie8"><input type="checkbox" name="int_h{{ $count }}[]" value="{{ $designation->id }}"><i></i></label>
									<!--<![endif]-->
								</p></td>
								@break
							@endif
						@endforeach
						
						@if ($exist == 0)
							<td><p><i class="fa fa-lock"></i></p></td>
						@endif
						
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<input type="hidden" name="hdn_increment" value="{{ $count }}">
@show