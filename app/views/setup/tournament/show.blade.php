@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-trophy"></i> Tournament Update</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => array('tournament.update', $data['tournament']->tournament_key), 'class' => 'sky-form', 'method' => 'PUT')) }}
                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Name</label></section>
                        <section class="col col-5">
                            <label class="input @if ($errors->has('tournament_name')) state-error @endif">
                                    <i class="icon-append fa fa-trophy"></i>
                                    <input type="text" name="tournament_name" value="{{ (Input::old('tournament_name')) ? Input::old('tournament_name') : $data['tournament']->tournament_name }}">
                                    {{ $errors->first('tournament_name', '<em for="tournament_name" class="invalid error-msg">:message</em>') }}
                                </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"> Description</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('tournament_description')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="tournament_description">{{ (Input::old('tournament_description')) ? Input::old('tournament_description') : $data['tournament']->tournament_description }}</textarea>
                                {{ $errors->first('tournament_description', '<em for="tournament_description" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"> Organizer</label></section>
                        <section class="col col-10">
                            <label class="input @if ($errors->has('tournament_organizer')) state-error @endif">
                                    <i class="icon-append fa fa-group"></i>
                                    <input type="text" name="tournament_organizer" value="{{ (Input::old('tournament_organizer')) ? Input::old('tournament_organizer') : $data['tournament']->tournament_organizer }}">
                                    {{ $errors->first('tournament_organizer', '<em for="tournament_organizer" class="invalid error-msg">:message</em>') }}
                                </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Date From</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('tournament_date_from')) state-error @endif">
                                <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="tournament_date_from" value="{{ (Input::old('tournament_date_from')) ? Input::old('tournament_date_from') : date($shareView['date_format_1'], strtotime($data['tournament']->tournament_date_from)) }}" class="date">
                                {{ $errors->first('tournament_date_from', '<em for="tournament_date_from" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                        <section class="col col-1"></section>
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Date To</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('tournament_date_to')) state-error @endif">
                                <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="tournament_date_to" value="{{ (Input::old('tournament_date_to')) ? Input::old('tournament_date_to') : date($shareView['date_format_1'], strtotime($data['tournament']->tournament_date_to)) }}" class="date">
                                {{ $errors->first('tournament_date_to', '<em for="tournament_date_to" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Location</label></section>
                        <section class="col col-10">
                            <label class="input @if ($errors->has('tournament_location')) state-error @endif">
                                    <i class="icon-append fa fa-map-marker"></i>
                                    <input type="text" name="tournament_location" value="{{ (Input::old('tournament_location')) ? Input::old('tournament_location') : $data['tournament']->tournament_location }}">
                                    {{ $errors->first('tournament_location', '<em for="tournament_location" class="invalid error-msg">:message</em>') }}
                                </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"> Remarks</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('tournament_remarks')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="tournament_remarks">{{ (Input::old('tournament_remarks')) ? Input::old('tournament_remarks') : $data['tournament']->tournament_remarks }}</textarea>
                                {{ $errors->first('tournament_remarks', '<em for="tournament_remarks" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                        <section class="col col-3">
                            <label class="select @if ($errors->has('tournament_status')) state-error @endif">
                                <select name="tournament_status">
                                    @foreach($data["status"] as $key => $value)
                                        @if (Input::old('tournament_status') == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @elseif (Input::old('tournament_status') == "" && $data['tournament']->tournament_status == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="tournament_status" class="invalid error-msg">&nbsp;{{ $errors->first('tournament_status', ':message') }}</em>
                            </label>
                        </section>
                    </div>
                </fieldset>
                
                <footer>
                    <a href="{{ URL::to(Session::get('list_url')) }}" class="btn-u btn-u-default"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn-u"><i class="fa fa-save"></i> Save</button>
                </footer>
            {{ Form::close() }}
            <!-- End Form -->
        </div>
        <!-- End Form-Panel -->
    </div>
@stop