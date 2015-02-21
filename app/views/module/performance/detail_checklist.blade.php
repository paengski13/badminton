@section("content")
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
		
		@if ($performance['template_code'] == 'training')
			<fieldset>
				<div class="row">
					<section class="col col-12"><label class="label">Do you anticipate any change(s) in the employee’s job function, and if yes, what areas of training would he require to prepare him for the job? <strong> {{ $performance['record']->performance_training_job_function }}</strong></label></section>
				</div>
			</fieldset>
		@endif
	</div>
@stop