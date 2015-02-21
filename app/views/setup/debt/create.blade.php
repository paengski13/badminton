@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Debt Add</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => 'debt.store', 'class' => 'sky-form')) }}
            
                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Name</label></section>
                        <section class="col col-5">
                            <label class="input @if ($errors->has('debt_name')) state-error @endif">
                                <i class="icon-append fa fa-money"></i>
                                <input type="text" name="debt_name" value="{{ Input::old('debt_name') }}">
                                {{ $errors->first('debt_name', '<em for="debt_name" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"> Description</label></section>
                        <section class="col col-10">
                            <label class="textarea @if ($errors->has('debt_description')) state-error @endif">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea rows="4" name="debt_description">{{ Input::old('debt_description') }}</textarea>
                                {{ $errors->first('debt_description', '<em for="debt_description" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Sort Order</label></section>
                        <section class="col col-2">
                            <label class="input @if ($errors->has('debt_sort')) state-error @endif">
                                <i class="icon-append fa fa-sort-numeric-asc"></i>
                                <input type="text" name="debt_sort" value="{{ (Input::old('debt_sort')) ? Input::old('debt_sort') : $data['sort_last_value'] }}">
                                {{ $errors->first('debt_sort', '<em for="debt_sort" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                    
                    <div class="row">
                        <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                        <section class="col col-3">
                            <label class="select @if ($errors->has('debt_status')) state-error @endif">
                                <select name="debt_status">
                                    @foreach ($data["status"] as $key => $value)
                                        @if (Input::old('debt_status') == $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @elseif (Input::old('debt_status') == "" && $key == 'A')
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <i></i>
                                <em for="debt_status" class="invalid error-msg">&nbsp;{{ $errors->first('debt_status', ':message') }}</em>
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