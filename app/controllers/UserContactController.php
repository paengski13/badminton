<?php

class UserContactController extends \BaseController 
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteContact($id)
    {
        // where condition
        UserContact::userContactKey($id)->delete();
    }
    
}
