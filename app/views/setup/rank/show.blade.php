@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-graduation-cap"></i> Rank Update</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => array('rank.update', $data['rank']->rank_key), 'class' => 'sky-form', 'method' => 'PUT')) }}
                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Name</label></section>
                        <section class="col col-5">
                            <label class="input @if ($errors->has('rank_name')) state-error @endif">
                                    <i class="icon-append fa fa-graduation-cap"></i>
                                    <input type="text" name="rank_name" value="{{ (Input::old('rank_name')) ? Input::old('rank_name') : $data['rank']->rank_name }}">
                                    {{ $errors->first('rank_name', '<em for="rank_name" class="invalid error-msg">:message</em>') }}
                                </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"> Description</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('rank_description')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="rank_description">{{ (Input::old('rank_description')) ? Input::old('rank_description') : $data['rank']->rank_description }}</textarea>
                                {{ $errors->first('rank_description', '<em for="rank_name" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Sort Order</label></section>
                        <section class="col col-3">
                            <label class="input @if ($errors->has('rank_sort')) state-error @endif">
                                    <i class="icon-append fa fa-sort-numeric-asc"></i>
                                    <input type="text" name="rank_sort" value="{{ (Input::old('rank_sort')) ? Input::old('rank_sort') : $data['rank']->rank_sort }}">
                                    {{ $errors->first('rank_sort', '<em for="rank_sort" class="invalid error-msg">:message</em>') }}
                                </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                        <section class="col col-3">
                            <label class="select @if ($errors->has('rank_status')) state-error @endif">
                                <select name="rank_status">
                                    @foreach($data["status"] as $key => $value)
                                        @if (Input::old('rank_status') == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @elseif (Input::old('rank_status') == "" && $data['rank']->rank_status == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="rank_status" class="invalid error-msg">&nbsp;{{ $errors->first('rank_status', ':message') }}</em>
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