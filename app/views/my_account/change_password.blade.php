@extends("my_account.layout")
@section("show_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Change Password</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => array('MyAccountController@changePassword'), 'class' => 'sky-form', 'id' => 'form', 'method' => 'PUT', 'files' => true)) }}
                <fieldset>
                    <div class="row">
                        <section class="col col-6">
                            <label class="label"><i class="fa fa-asterisk"></i> Current Password</label>
                            <label class="input @if ($errors->has('current_password')) state-error @endif">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="current_password" value="">
                                {{ $errors->first('current_password', '<em for="current_password" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                        
                    <div class="row">
                        <section class="col col-6">
                            <label class="label"><i class="fa fa-asterisk"></i> New Password</label>
                            <label class="input @if ($errors->has('password')) state-error @endif">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="password" value="{{ (Input::old('password')) ? Input::old('password') : "" }}">
                                {{ $errors->first('password', '<em for="password" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                        <section class="col col-6">
                            <label class="label"><i class="fa fa-asterisk"></i> Confirm Password</label>
                            <label class="input @if ($errors->has('password_confirmation')) state-error @endif">
                                <i class="icon-append fa fa-lock"></i>
                                <input type="password" name="password_confirmation" value="{{ (Input::old('password_confirmation')) ? Input::old('password_confirmation') : "" }}">
                                {{ $errors->first('password_confirmation', '<em for="password_confirmation" class="invalid error-msg">:message</em>') }}
                            </label>
                        </section>
                    </div>
                </fieldset>
                
                <footer>
                    <button type="submit" class="btn-u"><i class="fa fa-save"></i> Save</button>
                </footer>
            {{ Form::close() }}
            <!-- End Form -->
            
        </div>
        <!-- End Form-Panel -->
    </div>
    
    <script type="text/javascript">
    $(document).ready(function () {
        $("input[name=user_photo]").change(function (){
            var fd = new FormData(document.getElementById("form"));
            
            $.ajax({
                url: $('input[name=base_url]').val() + '/my_account/info/upload',
                type: "POST",
                data: fd,
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                
            })
            .done(function(data) {
                if (data == 'error') {
                    // display a message to the user
                    $('#message_alert_small').modal('toggle');
                    $('#message_alert_small_label').html('<i class="fa fa-warning"> Error</i>');
                    $('#message_content_small').html('Invalid extension file image. Please use .jpeg, .png, .gif or .bmp');
                } else {
                    $("#img_user_photo").attr("src", $('input[name=base_url]').val() + '/' + data);
                }
            });
            return false;
        });
    });
    </script>
@stop