@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-map-marker"></i> Location Add</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => 'location.store', 'class' => 'sky-form')) }}
            
                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Name</label></section>
                        <section class="col col-5">
                            <label class="input @if ($errors->has('location_name')) state-error @endif">
                                <i class="icon-append fa fa-map-marker"></i>
                                <input type="text" name="location_name" value="{{ Input::old('location_name') }}">
                                {{ $errors->first('location_name', '<em for="location_name" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Address</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('location_address')) state-error @endif">
                                <i class="icon-append fa fa-map-marker"></i>
                                <textarea rows="4" name="location_address">{{ Input::old('location_address') }}</textarea>
                                {{ $errors->first('location_address', '<em for="location_address" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"> Description</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('location_description')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="location_description">{{ Input::old('location_description') }}</textarea>
                                {{ $errors->first('location_description', '<em for="location_description" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                        <section class="col col-3">
                            <label class="select @if ($errors->has('location_status')) state-error @endif">
                                <select name="location_status">
                                    @foreach ($data["status"] as $key => $value)
                                        @if (Input::old('location_status') == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @elseif (Input::old('location_status') == "" && $key == 'A')
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="location_status" class="invalid error-msg">&nbsp;{{ $errors->first('location_status', ':message') }}</em>
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