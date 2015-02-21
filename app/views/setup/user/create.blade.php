@extends("setup.layout")
@section("setup_content")
    <div class="col-md-10">
        <!-- Begin Form-Panel -->
        <div class="table-search-v1 panel panel-grey">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> User Add</h3>
            </div>
            <!-- Form -->
            {{ Form::open(array('action' => 'user.store', 'class' => 'sky-form', 'id' => 'form', 'files' => true)) }}
                <div class="tab-v2">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#tab-access" data-toggle="tab">Access</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Profile -->
                        <div class="tab-pane fade in active" id="tab-profile">
                            <fieldset>
                                <div class="headline"><h4>Basic Profile</h4></div>
                                
                                <div class="row">
                                    <section class="col col-2">
                                         @if ($data["user_photo"] == "")
                                            <img class="img-responsive md-margin-bottom-10" id="img_user_photo" src="{{ URL::to('assets/img/user/no_image.png') }}" alt="">
                                        @else
                                            <img class="img-responsive md-margin-bottom-10" id="img_user_photo" src="{{ URL::to(UPLOAD_USER_PHOTO_PATH . '/' . $data['user_photo']) }}" alt="">
                                        @endif
                                    </section>
                                    <section class="col col-6">
                                        <label class="label"> Photo</label>
                                        <label for="file" class="input input-file @if ($errors->has('user_photo')) state-error @endif">
                                            <div class="button"><input type="file" name="user_photo" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" name="temp_user_photo" value="{{ Input::old('temp_user_photo') }}" readonly>
                                            {{ $errors->first('user_photo', '<em for="user_photo" class="invalid error-msg">:message</em>') }}
                                        </label>
                                        <label class='note'>Extension files: .jpeg, .png, .gif & .bmp</label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label"><i class="fa fa-asterisk"></i> First Name</label>
                                        <label class="input @if ($errors->has('user_firstname')) state-error @endif">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="user_firstname" value="{{ Input::old('user_firstname') }}">
                                            {{ $errors->first('user_firstname', '<em for="user_firstname" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label"> Middle Name</label>
                                        <label class="input @if ($errors->has('user_middlename')) state-error @endif">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="user_middlename" value="{{ Input::old('user_middlename') }}">
                                            {{ $errors->first('user_middlename', '<em for="user_middlename" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label"> Last Name</label>
                                        <label class="input @if ($errors->has('user_lastname')) state-error @endif">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="user_lastname" value="{{ Input::old('user_lastname') }}">
                                            {{ $errors->first('user_lastname', '<em for="user_lastname" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label"> Alias</label>
                                        <label class="input @if ($errors->has('user_alias')) state-error @endif">
                                            <i class="icon-append fa fa-desktop"></i>
                                            <input type="text" name="user_alias" value="{{ Input::old('user_alias') }}">
                                            {{ $errors->first('user_alias', '<em for="user_alias" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label"><i class="fa fa-asterisk"></i> Gender</label>
                                        <label class="select @if ($errors->has('user_gender')) state-error @endif">
                                            <select name="user_gender">
                                                <option value="" selected>--- select ---</option>
                                                @foreach ($data["gender"] as $key => $value)
                                                    @if (Input::old('user_gender') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                            <em for="user_gender" class="invalid error-msg">&nbsp;{{ $errors->first('user_gender', ':message') }}</em>
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label"> Civil Status</label>
                                        <label class="select @if ($errors->has('user_civil_status')) state-error @endif">
                                            <select name="user_civil_status">
                                                <option value="" selected>--- select ---</option>
                                                @foreach ($data["civil_status"] as $key => $value)
                                                    @if (Input::old('user_civil_status') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                            <em for="user_civil_status" class="invalid error-msg">&nbsp;{{ $errors->first('user_civil_status', ':message') }}</em>
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label"> Birthday</label>
                                        <label class="input @if ($errors->has('user_birth_date')) state-error @endif">
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="user_birth_date" value="{{ Input::old('user_birth_date') }}" class="date">
                                            {{ $errors->first('user_birth_date', '<em for="user_birth_date" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label"><i class="fa fa-asterisk"></i> Joined Date</label>
                                        <label class="input @if ($errors->has('user_joined_date')) state-error @endif">
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="user_joined_date" value="{{ Input::old('user_joined_date') }}" class="date_month_year">
                                            {{ $errors->first('user_joined_date', '<em for="user_joined_date" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>

                                    <section class="col col-4">
                                        <label class="label"> Left Date</label>
                                        <label class="input @if ($errors->has('user_left_date')) state-error @endif">
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="user_left_date" value="{{ Input::old('user_left_date') }}" class="date_month_year">
                                            {{ $errors->first('user_left_date', '<em for="user_left_date" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <div class="headline"><h4>Contact Details</h4></div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Email</label></section>
                                    <section class="col col-5">
                                        <label class="input @if ($errors->has('user_email')) state-error @endif">
                                            <i class="icon-append fa fa-envelope"></i>
                                            <input type="text" name="user_email" value="{{ Input::old('user_email') }}">
                                            {{ $errors->first('user_email', '<em for="user_email" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                @if(Input::old('hdn_increment'))
                                    {? $k = Input::old('hdn_increment'); ?}
                                @else
                                    {? $k = 1; ?}
                                @endif
                                
                                @for ($i = 1; $i <= $k; $i++)
                                    @if (Input::old('hdn_index'.$i) == 'Y' OR $i == '1')
                                        <div id="record_{{ $i }}" class="row clonedField">
                                            <section class="col col-3"><label class="label country_key{{ $i }}"><i class="@if ($i == 1) fa fa-asterisk @endif label_country_key{{ $i }}"></i> Phone Number</label></section>
                                            <section class="col col-3">
                                                <label class="select label_input_country_key{{ $i }} @if ($errors->has('country_key' . $i)) state-error @endif">
                                                    <select id="country_key{{ $i }}" name="country_key{{ $i }}" class="input_country_key{{ $i }}">
                                                        <option value="" selected>--- select ---</option>
                                                         @foreach ($data["countries"] as $country)
                                                            @if (Input::old('country_key' . $i) == $country->country_key)
                                                                <option value="{{ $country->country_key }}" selected>{{ $country->country_call }}</option>
                                                            @else
                                                                <option value="{{ $country->country_key }}">{{ $country->country_call }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <i></i>
                                                    <em class="invalid error-msg error_input_country_key{{$i}}">&nbsp;{{ $errors->first("country_key$i", ':message') }}</em>
                                                </label>
                                            </section>
                                            <section class="col col-4">
                                                <label class="input label_input_user_contact_phone_number{{ $i }} @if ($errors->has('user_contact_phone_number' . $i)) state-error @endif">
                                                    <i class="icon-append fa fa-phone"></i>
                                                    <input type="text" name="user_contact_phone_number{{ $i }}" value="{{ Input::old('user_contact_phone_number' . $i) }}" class="input_user_contact_phone_number{{ $i }}">
                                                    {{ $errors->first("user_contact_phone_number$i", "<em class='invalid error-msg error_input_user_contact_phone_number$i'>:message</em>") }}
                                                </label>
                                            </section>
                                            
                                            <section class="col col-1 pull-middle">
                                                <button type="button" name="btn_field_add" id="btn_field_add" class="btn btn-success btn_field_add btn-xs @if ($i != 1) hidden @endif"><i class="fa fa-plus-circle"></i> Add</button>   
                                                <button type="button" name="btn_field_delete{{ $i }}" id="btn_field_delete{{ $i }}" class="btn btn-danger btn-xs btn_field_delete @if ($i == 1) hidden @endif "><i class="fa fa-minus-circle"></i> Delete</button>
                                                <input type="hidden" name="hdn_index{{ $i }}" id="hdn_index{{ $i }}" value="Y">
                                            </section>
                                        </div>
                                    @endif
                                @endfor
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Hometown Address</label></section>
                                    <section class="col col-9">
                                        <label class="input @if ($errors->has('user_hometown_address')) state-error @endif">
                                            <i class="icon-append fa fa-home"></i>
                                            <input type="text" name="user_hometown_address" value="{{ Input::old('user_hometown_address') }}">
                                            {{ $errors->first('user_hometown_address', '<em for="user_hometown_address" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Overseas Address</label></section>
                                    <section class="col col-9">
                                        <label class="input @if ($errors->has('user_overseas_address')) state-error @endif">
                                            <i class="icon-append fa fa-home"></i>
                                            <input type="text" name="user_overseas_address" value="{{ Input::old('user_overseas_address') }}">
                                            {{ $errors->first('user_overseas_address', '<em for="user_overseas_address" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <input type="hidden" name="hdn_actual_count" value="{{ (Input::old('hdn_actual_count')) ? Input::old('hdn_actual_count') : 1 }}">
                                <input type="hidden" name="hdn_increment" value="{{ (Input::old('hdn_increment')) ? Input::old('hdn_increment') : 1 }}">
                                <input type="hidden" name="hdn_setup" value="phone_number">
                                
                                <script type="text/javascript">
                                    var inputs = {{ json_encode(Input::old()) }};
                                </script>
                            </fieldset>
                            
                            <fieldset>
                                <div class="headline"><h4>Emergency Contact Details</h4></div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Contact Person</label></section>
                                    <section class="col col-6">
                                        <label class="input @if ($errors->has('user_emergency_name')) state-error @endif">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="user_emergency_name" value="{{ Input::old('user_emergency_name') }}">
                                            {{ $errors->first('user_emergency_name', '<em for="user_emergency_name" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Relationship</label></section>
                                    <section class="col col-4">
                                        <label class="select @if ($errors->has('user_emergency_relation')) state-error @endif">
                                            <select name="user_emergency_relation">
                                                <option value="" selected>--- select ---</option>
                                                @foreach ($data["relationship"] as $key => $value)
                                                    @if (Input::old('user_emergency_relation') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                            <em for="user_emergency_relation" class="invalid error-msg">&nbsp;{{ $errors->first('user_emergency_relation', ':message') }}</em>
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Address</label></section>
                                    <section class="col col-9">
                                        <label class="input @if ($errors->has('user_emergency_address')) state-error @endif">
                                            <i class="icon-append fa fa-home"></i>
                                            <input type="text" name="user_emergency_address" value="{{ Input::old('user_emergency_address') }}">
                                            {{ $errors->first('user_emergency_address', '<em for="user_emergency_address" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-3"><label class="label"> Phone Number</label></section>
                                    <section class="col col-3">
                                        <label class="select @if ($errors->has('emergency_country_key')) state-error @endif">
                                            <select name="emergency_country_key">
                                                <option value="" selected>--- select ---</option>
                                                @foreach ($data["countries"] as $country)
                                                    @if (Input::old('emergency_country_key') == $country->country_key)
                                                        <option value="{{ $country->country_key }}" selected>{{ $country->country_call }}</option>
                                                    @else
                                                        <option value="{{ $country->country_key }}">{{ $country->country_call }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                            <em for="emergency_country_key" class="invalid error-msg">&nbsp;{{ $errors->first('emergency_country_key', ':message') }}</em>
                                        </label>
                                    </section>
                                    
                                    <section class="col col-4">
                                        <label class="input @if ($errors->has('user_emergency_phone')) state-error @endif">
                                            <i class="icon-append fa fa-phone"></i>
                                            <input type="text" name="user_emergency_phone" value="{{ Input::old('user_emergency_phone') }}" class="input_user_contact_phone_number">
                                            {{ $errors->first('user_emergency_phone', '<em for="user_emergency_phone" class="invalid error-msg">:message</em>') }}
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <div class="row">
                                    <section class="col col-3"><label class="label"><i class="fa fa-asterisk"></i> Status</label></section>
                                    <section class="col col-3">
                                        <label class="select @if ($errors->has('user_status')) state-error @endif">
                                            <select name="user_status">
                                                <option value="" selected>--- select ---</option>
                                                @foreach ($data["status"] as $key => $value)
                                                    @if (Input::old('user_status') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @elseif (Input::old('user_status') == "" && $key == 'A')
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <i></i>
                                           <em for="user_status" class="invalid error-msg">&nbsp;{{ $errors->first('user_status', ':message') }}</em>
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                        </div>
                        <!-- End Profile -->
                        
                        <!-- End Access -->
                        <div class="tab-pane fade" id="tab-access">
                            <fieldset>
                                <div class="row">
									<section class="col col-2"><label class="label"> Access</label></section>
									<section class="col col-4">
										<div class="row">
											@foreach ($data["access"] as $key => $value)
												@if (is_array(Input::old('access_user')) && in_array($value->id, Input::old('access_user')))
													<label class="checkbox"><input type="checkbox" name="access_user[]" value="{{ $value->id }}" checked ><i></i>{{ $value->access_name }}</label>
												@else
                                                    <label class="checkbox"><input type="checkbox" name="access_user[]" value="{{ $value->id }}" ><i></i>{{ $value->access_name }}</label>
												@endif
											@endforeach
										</div>
									</section>
								</div>
							</fieldset>
                        </div>
                        <!-- End Access -->
                    </div>
                </div>
                
                <footer>
                    <a href="{{ URL::to(Session::get('list_url')) }}" class="btn-u btn-u-default"><i class="fa fa-arrow-left"></i> Back</a>
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
                url: $('input[name=base_url]').val() + '/user/photo/upload',
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