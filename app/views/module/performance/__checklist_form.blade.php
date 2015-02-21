@section("checklist_form")
    <fieldset>
        <div class="row">
            <section class="col col-12"><label class="label"> Do you anticipate any change(s) in the employee’s job function, and if yes, what areas of training would he require to prepare him for the job?</label></section>
        </div>
        
        <div class="row">
            <section class="col col-11">
                <label class="textarea @if ($errors->has('performance_training_job_function')) state-error @endif">
                    <i class="icon-append fa fa-comment"></i>
                    <textarea rows="4" name="performance_training_job_function">{{ Input::old('performance_training_job_function') }}</textarea>
                    {{ $errors->first('performance_training_job_function', '<em for="performance_training_job_function" class="invalid error-msg">:message</em>') }}
                </label>
            </section>
        </div>
    </fieldset>
@show