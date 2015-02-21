<?php

class LocationController extends \BaseController 
{
	// determine if user has access to this page
    private $page_access = '';
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        // check if user has access to this module
        if (Auth::check()) {
            if (!$this->checkAccess(LOCATION_TITLE, Auth::user()->access->toArray()) && Auth::user()->user_admin == NO) {
                $this->page_access = NO_ACCESS;
            }
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // redirect to home page if user has no access to this page
        if ($this->page_access) {
            return Redirect::to(strtolower(HOME_TITLE));
        }
        
		// header and module properties
		$this->data['page_module'] = LOCATION_MODULE;
		$this->data['page_title'] = LOCATION_TITLE;
    
        // search variables here
        $s_name = $this->getInput('s_name', '');
        $s_status = $this->getInput('s_status', '');
        
        // order variables here
        $sort_by = $this->getInput('sort_by', 'location.created_at');
        $order_by = $this->getInput('order_by', DESCENDING);
        
        // search location status
        $locations = Location::locationStatus($s_status)
			->locationName($s_name)
			->locationSort($sort_by, $order_by)
			->paginate(PAGINATION_LIMIT);
        // location records
        $this->data["locations"] = $locations;
        
        // previous search values
        $this->data["s_name"] = $s_name;
        $this->data["s_status"] = $s_status;
        
        // list of status
        $this->data["status"] = getOptionStatus();
        
        // current record number
        $this->data["count"] = $locations->getFrom();
        
        // search parameter to the pagination
        $this->data["url_pagination"] = array('sort_by' => $sort_by, 'order_by' => $order_by, 's_name' => $s_name, 's_status' => $s_status);

        // search parameter to the sorting
        $this->data["url_sort"] = array('sort_by' => $sort_by, 'order_by' => getSortOrder($order_by), 
                                        's_name' => $s_name, 's_status' => $s_status,
                                        'page' => $locations->getCurrentPage());

        // load the view and pass the location records
        return View::make('setup.location.index')->with('data', $this->data);
    }                                                                               


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		// header and module properties
		$this->data['page_module'] = LOCATION_MODULE;
		$this->data['page_title'] = LOCATION_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(LOCATION_TITLE));
        }
        
        // get status
        $this->data["status"] = getOptionStatus();
        
        // load the create form
        return View::make('setup.location.create')->with('data', $this->data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'location_name' => 'required|unique:location,location_name,NULL,id,deleted_at,NULL',
            'location_address' => 'required',
            'location_status' => 'required',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // redirect to list page
            Session::flash('danger', UNABLE_TO_SAVE);
            return Redirect::to(URL::previous())
                ->withErrors($validator)
                ->withInput();

        } else {
            // compose the fields to be updated
            $data = array();
            $data['location_key'] = generateRandomID();
            $data['location_name'] = $this->getInput('location_name', '');
            $data['location_address'] = $this->getInput('location_address', '');
            $data['location_description'] = $this->getInput('location_description', '');
            $data['location_status'] = $this->getInput('location_status', '');
            $data['created_by'] = Auth::user()->id;
            
            // create record
            $location = Location::create($data);

            // redirect to list page
            Session::flash('success', SUCCESS_CREATE);
            return Redirect::to($this->getPreviousListURL());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  string unique $id
     * @return Response
     */
    public function show($id)
    {
    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string unique $id
     * @return Response
     */
    public function edit($id)
    {
		// header and module properties
		$this->data['page_module'] = LOCATION_MODULE;
		$this->data['page_title'] = LOCATION_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(LOCATION_TITLE)); 
        }
        
        // get the selected record
        $location = Location::locationKey($id)->first();
        
        // check if the record really exist
        if (is_null($location)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(LOCATION_TITLE));
        }
		
        // get record
        $this->data["location"] = $location;
        
        // get status
        $this->data["status"] = getOptionStatus();

        // load the show form
        return View::make('setup.location.show')->with('data', $this->data);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'location_name' => 'required|unique:location,location_name,' . $id . ',location_key,deleted_at,NULL',
            'location_address' => 'required',
            'location_status' => 'required',
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
            $location = Location::locationKey($id)->first();
            
            // check if the record can be updated
            if (empty($location->id)) {
                // redirect to list page
                Session::flash('danger', SOMETHING_WENT_WRONG);
                return Redirect::to(strtolower(LOCATION_TITLE));
            }
			
            // fields to be updated
            $location->location_name = $this->getInput('location_name', '');
            $location->location_address = $this->getInput('location_address', '');
            $location->location_description = $this->getInput('location_description', '');
            $location->location_status = $this->getInput('location_status', '');
            $location->updated_by = Auth::user()->id;
            $location->save();
            
            // redirect to list page
            Session::flash('success', SUCCESS_UPDATE);
            return Redirect::to($this->getPreviousListURL());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // where condition
        $location = Location::locationKey($id)->first();
        
        // check if the record really exist
        if (is_null($location)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(LOCATION_TITLE));
        }
        
        // store user who deleted the record
        $location->deleted_by = Auth::user()->id;
        $location->save();
        
		// delete record
        $location->delete();

        // redirect to list page
        Session::flash('success', SUCCESS_DELETE);
        return Redirect::to(strtolower(LOCATION_TITLE));
    }
}
