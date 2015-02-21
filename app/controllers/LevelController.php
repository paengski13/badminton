<?php

class LevelController extends \BaseController 
{
	// determine if user has access to this page
    private $page_access = '';
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        // check if user has access to this module
        if (Auth::check()) {
            if (!$this->checkAccess(LEVEL_TITLE, Auth::user()->access->toArray()) && Auth::user()->user_admin == NO) {
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
		$this->data['page_module'] = LEVEL_MODULE;
		$this->data['page_title'] = LEVEL_TITLE;
    
        // search variables here
        $s_name = $this->getInput('s_name', '');
        $s_status = $this->getInput('s_status', '');
        
        // order variables here
        $sort_by = $this->getInput('sort_by', 'level.created_at');
        $order_by = $this->getInput('order_by', DESCENDING);
        
        // search level status
        $levels = Level::levelStatus($s_status)
			->levelName($s_name)
			->levelSort($sort_by, $order_by)
			->paginate(PAGINATION_LIMIT);
        // level records
        $this->data["levels"] = $levels;
        
        // previous search values
        $this->data["s_name"] = $s_name;
        $this->data["s_status"] = $s_status;
        
        // list of status
        $this->data["status"] = getOptionStatus();
        
        // current record number
        $this->data["count"] = $levels->getFrom();
        
        // search parameter to the pagination
        $this->data["url_pagination"] = array('sort_by' => $sort_by, 'order_by' => $order_by, 's_name' => $s_name, 's_status' => $s_status);

        // search parameter to the sorting
        $this->data["url_sort"] = array('sort_by' => $sort_by, 'order_by' => getSortOrder($order_by), 
                                        's_name' => $s_name, 's_status' => $s_status,
                                        'page' => $levels->getCurrentPage());

        // load the view and pass the level records
        return View::make('setup.level.index')->with('data', $this->data);
    }                                                                               


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		// header and module properties
		$this->data['page_module'] = LEVEL_MODULE;
		$this->data['page_title'] = LEVEL_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(LEVEL_TITLE));
        }
        
        // get status
        $this->data["status"] = getOptionStatus();
        
        // get the max rate value
        $this->data["sort_last_value"] = Level::max('level_sort') + 1;
        
        // load the create form
        return View::make('setup.level.create')->with('data', $this->data);
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
            'level_name' => 'required|unique:level,level_name,NULL,id,deleted_at,NULL',
            'level_sort' => 'required|integer|min:1',
            'level_status' => 'required',
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
            $data['level_key'] = generateRandomID();
            $data['level_name'] = $this->getInput('level_name', '');
            $data['level_description'] = $this->getInput('level_description', '');
            $data['level_sort'] = $this->getInput('level_sort', '');
            $data['level_status'] = $this->getInput('level_status', '');
            $data['created_by'] = Auth::user()->id;
            
            // create record
            $level = Level::create($data);

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
		$this->data['page_module'] = LEVEL_MODULE;
		$this->data['page_title'] = LEVEL_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(LEVEL_TITLE)); 
        }
        
        // get the selected record
        $level = Level::levelKey($id)->first();
        
        // check if the record really exist
        if (is_null($level)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(LEVEL_TITLE));
        }
		
        // get record
        $this->data["level"] = $level;
        
        // get status
        $this->data["status"] = getOptionStatus();

        // load the show form
        return View::make('setup.level.show')->with('data', $this->data);

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
            'level_name' => 'required|unique:level,level_name,' . $id . ',level_key,deleted_at,NULL',
            'level_sort' => 'required|integer|min:1',
            'level_status' => 'required',
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
            $level = Level::levelKey($id)->first();
            
            // check if the record can be updated
            if (empty($level->id)) {
                // redirect to list page
                Session::flash('danger', SOMETHING_WENT_WRONG);
                return Redirect::to(strtolower(LEVEL_TITLE));
            }
			
            // fields to be updated
            $level->level_name = $this->getInput('level_name', '');
            $level->level_description = $this->getInput('level_description', '');
            $level->level_sort = $this->getInput('level_sort', '');
            $level->level_status = $this->getInput('level_status', '');
            $level->updated_by = Auth::user()->id;
            $level->save();
            
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
        $level = Level::levelKey($id)->first();
        
        // check if the record really exist
        if (is_null($level)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(LEVEL_TITLE));
        }
        
        // store user who deleted the record
        $level->deleted_by = Auth::user()->id;
        $level->save();
        
		// delete record
        $level->delete();

        // redirect to list page
        Session::flash('success', SUCCESS_DELETE);
        return Redirect::to(strtolower(LEVEL_TITLE));
    }
}
