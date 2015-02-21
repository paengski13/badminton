<?php

class MyAccountController extends \BaseController 
{
	// determine if user has access to this page
    private $page_access = '';
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        // check if user has access to this module
        if (Auth::check()) {
            if (!$this->checkAccess(USER_TITLE, Auth::user()->access->toArray()) && Auth::user()->user_admin == NO) {
                $this->page_access = NO_ACCESS;
            }
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getMyInfo()
    {
        // header and module properties
		$this->data['page_module'] = MY_ACCOUNT_MODULE;
		$this->data['page_title'] = MY_INFO_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(MY_INFO_TITLE)); 
            
            // also remove the user_photo session
            Session::forget('user_photo');
        }
		
        // get record
        $this->data["user"] = Auth::user();
        
        // get record
        $this->data["user_contact"] = UserContact::userId(Auth::user()->id)->get();

        // get countries
        $this->data["countries"] = Country::countryStatus(ACTIVE)->countrySort('country_name', ASCENDING)->get();
        
        // get gender
        $this->data["gender"] = getOptionGender();
        
        // get civil status
        $this->data["civil_status"] = getOptionCivilStatus();
        
        // get civil status
        $this->data["relationship"] = getOptionRelationship();
        
        // get status
        $this->data["status"] = getOptionStatus();
        
        // get previously selected picture
        if (Session::has('user_photo')) {
            $this->data['user_photo'] = Session::get('user_photo');
        } else {
            $this->data['user_photo'] = "";
        }

        // load the show form
        return View::make('my_account.show')->with('data', $this->data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateMyInfo()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'user_firstname' => 'required',
            'user_gender' => 'required',
            'user_civil_status' => 'required',
            'user_birth_date' => 'required|date_format:"'.DATE_FORMAT_1,
            'user_joined_date' => 'required|date_format:"'.DATE_FORMAT_2,
            'user_email' => 'required|email|unique:user,user_email,' . Auth::user()->user_key . ',user_key,deleted_at,NULL',
            'country_key1' => 'required',
            'user_contact_phone_number1' => 'required',
            'user_hometown_address' => 'required',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // redirect to list page
            Session::flash('danger', UNABLE_TO_SAVE);
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        } else {
            // where condition
            $user = Auth::user();
            
            // check if the record can be updated
            if (empty($user->id)) {
                // redirect to list page
                Session::flash('danger', SOMETHING_WENT_WRONG);
                return Redirect::to(strtolower(USER_TITLE));
            }
			
            // fields to be updated
            $user->user_firstname = $this->getInput('user_firstname', '');
            $user->user_middlename = $this->getInput('user_middlename', '');
            $user->user_lastname = $this->getInput('user_lastname', '');
            $user->user_alias = $this->getInput('user_alias', '');
            $user->user_gender = $this->getInput('user_gender', '');
            $user->user_civil_status = $this->getInput('user_civil_status', '');
            $user->user_birth_date = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('user_birth_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $user->user_joined_date = $this->getInput('user_joined_date', '');
            $user->user_email = $this->getInput('user_email', '');
            $user->user_hometown_address = $this->getInput('user_hometown_address', '');
            $user->user_overseas_address = $this->getInput('user_overseas_address', '');
            if (Session::has('user_photo')) {
                $user->user_photo = Session::get('user_photo');
                Session::forget('user_photo');
            }
            $user->updated_by = Auth::user()->id;
            
            // update record
            $user->save();
            
            for ($cnt = 1; $cnt <= $this->getInput('hdn_increment', ''); $cnt++) {
                if ($this->getInput('hdn_index' . $cnt, '') == YES && $this->getInput('country_key' . $cnt, '') != EMPTY_STRING && $this->getInput('user_contact_phone_number' . $cnt, '') != EMPTY_STRING) {
                    if ($this->getInput('user_contact_key' . $cnt, '') == EMPTY_STRING) {
                        $data = array();
                        $data['user_contact_key'] = generateRandomID();
                        $data['user_id'] = $user->id;
                        $data['country_id'] = Country::countryKey($this->getInput('country_key' . $cnt, ''))->pluck('id');
                        $data['user_contact_phone_number'] = $this->getInput('user_contact_phone_number' . $cnt, '');
                        $data['created_by'] = Auth::user()->id;
                        
                        // create record
                        UserContact::create($data);
                    } else {
                        // where condition
                        $user_contact = UserContact::UserContactKey($this->getInput('user_contact_key' . $cnt, ''))->first();
                        
                        // check if the record can be updated
                        if (isset($user_contact->id)) {
                            $user_contact->country_id = Country::countryKey($this->getInput('country_key' . $cnt, ''))->pluck('id');
                            $user_contact->user_contact_phone_number = $this->getInput('user_contact_phone_number' . $cnt, '');
                            $user_contact->updated_by = Auth::user()->id;
                    
                            // update record
                            $user_contact->save();
                        }
                    }
                }
            }
            
            // where condition
            $user_emergency = UserEmergency::userId($user->id)->first();
            
            // check if the record can be updated
            if (!empty($user_emergency->id)) {
                // fields to be updated
                $user_emergency->user_emergency_name = $this->getInput('user_emergency_name', '');
                $user_emergency->user_emergency_relation = $this->getInput('user_emergency_relation', '');
                $user_emergency->user_emergency_address = $this->getInput('user_emergency_address', '');
                $user_emergency->country_id = Country::countryKey($this->getInput('emergency_country_key', ''))->pluck('id');
                $user_emergency->user_emergency_phone = $this->getInput('user_emergency_phone', '');
                $user_emergency->updated_by = Auth::user()->id;
                    
                // update record
                $user_emergency->save();
            }
            
            // redirect to list page
            Session::flash('success', SUCCESS_UPDATE);
            return Redirect::to('my_account/info');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function viewChangePassword()
    {
        // header and module properties
		$this->data['page_module'] = MY_ACCOUNT_MODULE;
		$this->data['page_title'] = CHANGE_PASSWORD_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(CHANGE_PASSWORD_TITLE)); 
            
            // also remove the user_photo session
            Session::forget('user_photo');
        }

        // load the show form
        return View::make('my_account.change_password')->with('data', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function changePassword()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'current_password' => 'required|check_password:'.Input::get('current_password'),
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // redirect to list page
            Session::flash('danger', UNABLE_TO_SAVE);
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        } else {
            if (Hash::check(Input::get('current_password'), Auth::user()->password)) {
                $user = User::find(Auth::user()->id);
            
                $user->password = Hash::make(Input::get('password'));
                $user->save();
            }
            
            #echo"<pre>";print_r(Input::all());echo Auth::user()->password;echo"</pre>";exit;
            
            
        }

        // redirect to list page
        Session::flash('success', SUCCESS_UPDATE);
        return Redirect::to('my_account/password');
    }
    
    
    /**
     * upload photo
     *
     * @param  
     * @return photo
     */
    public function uploadPhoto()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'user_photo' => 'mimes:jpeg,bmp,png'
        );
        
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return "error";
        } else {
            if (!is_null(Input::file('user_photo'))) {
                $upload_file = Input::file('user_photo');
                $new_file = str_random(10) . '_' . date("Ymdhis") . "." . $upload_file->getClientOriginalExtension();
                $upload_success = $upload_file->move(UPLOAD_USER_PHOTO_PATH, $new_file);
                
                Session::put('user_photo', $new_file);
                return UPLOAD_USER_PHOTO_PATH . '/' . $new_file;
            }
        }
    }
    
}
