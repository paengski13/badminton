@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> User Invite</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => array('UserController@sendInvite'), 'class' => 'sky-form', 'id' => 'form', 'files' => true, 'method' => 'POST')) }}
                <!-- User Invite -->
                <div class="tab-pane fade in active" id="tab-profile">
                    <fieldset>
                        <div class="headline"><h4>Invite Form</h4></div>
                        
                        <div class="row">
                            <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> First Name</label></section>
                            <section class="col col-4">
                                <label class="input @if ($errors->has('user_firstname')) state-error @endif">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="user_firstname" value="{{ Input::old('user_firstname') }}">
                                    {{ $errors->first('user_firstname', '<em for="user_firstname" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                            
                            <section class="col col-2"><label class="label"> Last Name</label></section>
                            <section class="col col-4">
                                <label class="input @if ($errors->has('user_lastname')) state-error @endif">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="user_lastname" value="{{ Input::old('user_lastname') }}">
                                    {{ $errors->first('user_lastname', '<em for="user_lastname" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div>
                        
                        <div class="row">
                            <section class="col col-2"><label class="label"><i class="fa fa-asterisk"></i> Email</label></section>
                            <section class="col col-6">
                                <label class="input @if ($errors->has('user_email')) state-error @endif">
                                    <i class="icon-append fa fa-envelope"></i>
                                    <input type="text" name="user_email" value="{{ Input::old('user_email') }}">
                                    {{ $errors->first('user_email', '<em for="user_email" class="invalid error-msg">:message</em>') }}
                                </label>
                            </section>
                        </div>
                    </fieldset>
                </div>
                <!-- End User Invite -->
                
                <footer>
                    <a href="{{ URL::to(Session::get('list_url')) }}" class="btn-u btn-u-default"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn-u"><i class="fa fa-send"></i> Send Invite</button>
                </footer>
            {{ Form::close() }}
            <!-- End Form -->
        </div>
        <!-- End Form-Panel -->
    </div>
@stop