@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gamepad"></i> Game Update</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => array('game.update', $data['game']->game_key), 'class' => 'sky-form', 'method' => 'PUT')) }}
            
                <fieldset>
                    <div class="headline"><h4>Game Details</h4></div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Name</label></section>
                        <section class="col col-7">
                            <label class="input @if ($errors->has('game_name')) state-error @endif">
                                <i class="icon-append fa fa-gamepad"></i>
                                <input type="text" name="game_name" value="{{ (Input::old('game_name')) ? Input::old('game_name') : $data['game']->game_name }}">
                                {{ $errors->first('game_name', '<em for="game_name" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Location</label></section>
                        <section class="col col-7">
                            <label class="select @if ($errors->has('location_key')) state-error @endif">
                                <select name="location_key">
                                    <option value="" selected>--- select ---</option>
                                    @foreach ($data["locations"] as $location)
                                        @if (Input::old('location_key') == $location->location_key)
                                            <option value="{{ $location->location_key }}" selected>{{ $location->location_name }}</option>
                                        @elseif (Input::old('location_key') == "" && $location->location_key == $data['game']->Location->location_key)
                                            <option value="{{ $location->location_key }}" selected>{{ $location->location_name }}</option>
                                        @else
                                            <option value="{{ $location->location_key }}">{{ $location->location_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="location_key" class="invalid error-msg">&nbsp;{{ $errors->first('location_key', ':message') }}</em>
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Date</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_date')) state-error @endif">
                                <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="game_date" value="{{ (Input::old('game_date')) ? Input::old('game_date') : \Carbon\Carbon::createFromFormat(DB_DATE_FORMAT, $data['game']->game_date)->format(DATE_FORMAT_1); }}" class="date">
                                {{ $errors->first('game_date', '<em for="game_date" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Max no. of Players</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_max_players')) state-error @endif">
                                <i class="icon-append fa fa-group"></i>
                                <input type="text" name="game_max_players" value="{{ (Input::old('game_max_players')) ? Input::old('game_max_players') : $data['game']->game_max_players }}">
                                {{ $errors->first('game_max_players', '<em for="game_max_players" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"> Remarks</label></section>
                        <section class="col col-9">
                            <label class="textarea @if ($errors->has('game_remarks')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="game_remarks">{{ (Input::old('game_remarks')) ? Input::old('game_remarks') : $data['game']->game_remarks }}</textarea>
                                {{ $errors->first('game_remarks', '<em for="game_remarks" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>
                
                <fieldset>
                    <div class="headline"><h4>Amount Details</h4></div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Payment per Person</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_amount')) state-error @endif">
                                <i class="icon-append fa fa-dollar"></i>
                                <input type="text" name="game_amount" value="{{ (Input::old('game_amount')) ? Input::old('game_amount') : $data['game']->game_amount }}">
                                {{ $errors->first('game_amount', '<em for="game_amount" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Debt</label></section>
                        <section class="col col-5">
                            <label class="select @if ($errors->has('debt_key')) state-error @endif">
                                <select name="debt_key">
                                    <option value="" selected>--- select ---</option>
                                    @foreach ($data["debts"] as $debt)
                                        @if (Input::old('debt_key') == $debt->debt_key)
                                            <option value="{{ $debt->debt_key }}" selected>{{ $debt->debt_name }}</option>
                                        @elseif (Input::old('debt_key') == "" && $debt->debt_key == $data['game']->Debt->debt_key)
                                            <option value="{{ $debt->debt_key }}" selected>{{ $debt->debt_name }}</option>
                                        @else
                                            <option value="{{ $debt->debt_key }}">{{ $debt->debt_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="debt_key" class="invalid error-msg">&nbsp;{{ $errors->first('debt_key', ':message') }}</em>
                            </label>
                        </section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_debt_amount')) state-error @endif">
                                <i class="icon-append fa fa-dollar"></i>
                                <input type="text" name="game_debt_amount" value="{{ (Input::old('game_debt_amount')) ? Input::old('game_debt_amount') : $data['game']->game_debt_amount }}">
                                {{ $errors->first('game_debt_amount', '<em for="game_debt_amount" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="headline"><h4>Schedule Email</h4></div>
                    
                    <div class="row">
                        <section class="col col-11"><label class="label"> <i class="fa fa-calendar"></i> <i class="fa fa-envelope"></i> All scheduled email notifications & announcements will be sent every 10:00 AM (Singapore Time)</label></section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"> Announcement Date </label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_announce_date')) state-error @endif">
                                <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="game_announce_date" value="{{ (Input::old('game_announce_date') || $data['game']->game_announce_date == '1970-01-01') ? Input::old('game_announce_date') : \Carbon\Carbon::createFromFormat(DB_DATE_FORMAT, $data['game']->game_announce_date)->format(DATE_FORMAT_1); }}" class="date">
                                {{ $errors->first('game_announce_date', '<em for="game_announce_date" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-3"><label class="label"> Announcement Final List Date</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('game_announce_final_date')) state-error @endif">
                                <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="game_announce_final_date" value="{{ (Input::old('game_announce_final_date') || $data['game']->game_announce_final_date == '1970-01-01') ? Input::old('game_announce_final_date') : \Carbon\Carbon::createFromFormat(DB_DATE_FORMAT, $data['game']->game_announce_final_date)->format(DATE_FORMAT_1); }}" class="date">
                                {{ $errors->first('game_announce_final_date', '<em for="game_announce_final_date" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                        <section class="col col-3">
                            <label class="select @if ($errors->has('game_status')) state-error @endif">
                                <select name="game_status">
                                    @foreach ($data["status"] as $key => $value)
                                        @if (Input::old('game_status') == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @elseif (Input::old('game_status') == "" && $data['game']->game_status == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="game_status" class="invalid error-msg">&nbsp;{{ $errors->first('game_status', ':message') }}</em>
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