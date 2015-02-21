<?php

class TournamentController extends \BaseController 
{
	// determine if user has access to this page
    private $page_access = '';
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        // check if user has access to this module
        if (Auth::check()) {
            if (!$this->checkAccess(TOURNAMENT_TITLE, Auth::user()->access->toArray()) && Auth::user()->user_admin == NO) {
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
		$this->data['page_module'] = TOURNAMENT_MODULE;
		$this->data['page_title'] = TOURNAMENT_TITLE;
    
        // search variables here
        $s_name = $this->getInput('s_name', '');
        $s_status = $this->getInput('s_status', '');
        
        // order variables here
        $sort_by = $this->getInput('sort_by', 'tournament.created_at');
        $order_by = $this->getInput('order_by', DESCENDING);
        
        // search tournament status
        $tournaments = Tournament::tournamentStatus($s_status)
			->tournamentName($s_name)
			->tournamentSort($sort_by, $order_by)
			->paginate(PAGINATION_LIMIT);
        // tournament records
        $this->data["tournaments"] = $tournaments;
        
        // previous search values
        $this->data["s_name"] = $s_name;
        $this->data["s_status"] = $s_status;
        
        // list of status
        $this->data["status"] = getOptionStatus();
        
        // current record number
        $this->data["count"] = $tournaments->getFrom();
        
        // search parameter to the pagination
        $this->data["url_pagination"] = array('sort_by' => $sort_by, 'order_by' => $order_by, 's_name' => $s_name, 's_status' => $s_status);

        // search parameter to the sorting
        $this->data["url_sort"] = array('sort_by' => $sort_by, 'order_by' => getSortOrder($order_by), 
                                        's_name' => $s_name, 's_status' => $s_status,
                                        'page' => $tournaments->getCurrentPage());

        // load the view and pass the tournament records
        return View::make('setup.tournament.index')->with('data', $this->data);
    }                                                                               


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		// header and module properties
		$this->data['page_module'] = TOURNAMENT_MODULE;
		$this->data['page_title'] = TOURNAMENT_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(TOURNAMENT_TITLE));
        }
        
        // get status
        $this->data["status"] = getOptionStatus();
        
        // load the create form
        return View::make('setup.tournament.create')->with('data', $this->data);
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
            'tournament_name' => 'required|unique:tournament,tournament_name,NULL,id,deleted_at,NULL',
            'tournament_date_from' => 'required|date_format:' . DATE_FORMAT_1,
            'tournament_date_to' => 'required|date_format:' . DATE_FORMAT_1,
            'tournament_location' => 'required',
            'tournament_status' => 'required',
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
            $data['tournament_key'] = generateRandomID();
            $data['tournament_name'] = $this->getInput('tournament_name', '');
            $data['tournament_description'] = $this->getInput('tournament_description', '');
            $data['tournament_date_from'] = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('tournament_date_from', ''))->format(DB_DATE_FORMAT);
            $data['tournament_date_to'] = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('tournament_date_to', ''))->format(DB_DATE_FORMAT);
            $data['tournament_location'] = $this->getInput('tournament_location', '');
            $data['tournament_organizer'] = $this->getInput('tournament_organizer', '');
            $data['tournament_remarks'] = $this->getInput('tournament_remarks', '');
            $data['tournament_status'] = $this->getInput('tournament_status', '');
            $data['created_by'] = Auth::user()->id;
            
            // create record
            $tournament = Tournament::create($data);

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
		$this->data['page_module'] = TOURNAMENT_MODULE;
		$this->data['page_title'] = TOURNAMENT_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(TOURNAMENT_TITLE)); 
        }
        
        // get the selected record
        $tournament = Tournament::tournamentKey($id)->first();
        
        // check if the record really exist
        if (is_null($tournament)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(TOURNAMENT_TITLE));
        }
		
        // get record
        $this->data["tournament"] = $tournament;
        
        // get status
        $this->data["status"] = getOptionStatus();

        // load the show form
        return View::make('setup.tournament.show')->with('data', $this->data);

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
            'tournament_name' => 'required|unique:tournament,tournament_name,' . $id . ',tournament_key,deleted_at,NULL',
            'tournament_date_from' => 'required|date_format:' . DATE_FORMAT_1,
            'tournament_date_to' => 'required|date_format:' . DATE_FORMAT_1,
            'tournament_location' => 'required',
            'tournament_status' => 'required',
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
            $tournament = Tournament::tournamentKey($id)->first();
            
            // check if the record can be updated
            if (empty($tournament->id)) {
                // redirect to list page
                Session::flash('danger', SOMETHING_WENT_WRONG);
                return Redirect::to(strtolower(TOURNAMENT_TITLE));
            }
			
            // fields to be updated
            $tournament->tournament_name = $this->getInput('tournament_name', '');
            $tournament->tournament_description = $this->getInput('tournament_description', '');
            $tournament->tournament_date_from = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('tournament_date_from', ''))->format(DB_DATE_FORMAT);
            $tournament->tournament_date_to = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('tournament_date_to', ''))->format(DB_DATE_FORMAT);
            $tournament->tournament_location = $this->getInput('tournament_location', '');
            $tournament->tournament_organizer = $this->getInput('tournament_organizer', '');
            $tournament->tournament_remarks = $this->getInput('tournament_remarks', '');
            $tournament->tournament_status = $this->getInput('tournament_status', '');
            $tournament->updated_by = Auth::user()->id;
            $tournament->save();
            
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
        $tournament = Tournament::tournamentKey($id)->first();
        
        // check if the record really exist
        if (is_null($tournament)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(TOURNAMENT_TITLE));
        }
        
        // store user who deleted the record
        $tournament->deleted_by = Auth::user()->id;
        $tournament->save();
        
		// delete record
        $tournament->delete();

        // redirect to list page
        Session::flash('success', SUCCESS_DELETE);
        return Redirect::to(strtolower(TOURNAMENT_TITLE));
    }
}
