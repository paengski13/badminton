<?php

class BaseController extends Controller {

    // holds all information to be submitted in view layer
    protected $data = array();

	
	/**
	 * Keep the previous page search filter and pagination.
	 *
	 * @return void
	 */
    protected function setPreviousListURL($module_url)
    {
        if (URL::to('') != URL::previous()) {
            // user came from the list page
            Session::put('list_url', URL::previous());
        } else {
            // user directly accessing create/update page
            Session::put('list_url', URL::to($module_url));
        }
    }
    
        
	/**
	 * Keep the previous page search filter and pagination.
	 *
	 * @return list_url URL
	 */
    protected function getPreviousListURL()
    {
        $list_url = Session::get('list_url');
        Session::forget('list_url');
        return $list_url;
    }
    

	/**
	 * validate input if exist, or with value
	 *
	 * @return return the value if not null, else set a default
	 */
    protected function getInput($value, $replace_value, $type = '')
    {
        if ($type == DATE_STRING) {
            return (Input::has($value)) ? Input::get($value) : $replace_value; 
        } else {
            return (Input::has($value)) ? Input::get($value) : $replace_value; 
        }
        
    }
    
    
	/**
	 * check access rights
	 *
	 * @return true if access is found, otherwise return false
	 */
    protected function checkAccess($needle, $haystack, $strict = false) 
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->checkAccess($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
}