<?php

class GameController extends \BaseController 
{
	// determine if user has access to this page
    private $page_access = '';
    
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
        // check if user has access to this module
        if (Auth::check()) {
            if (!$this->checkAccess(GAME_TITLE, Auth::user()->access->toArray()) && Auth::user()->user_admin == NO) {
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
		$this->data['page_module'] = GAME_MODULE;
		$this->data['page_title'] = GAME_TITLE;
    
        // search variables here
        $s_name = $this->getInput('s_name', '');
        $s_status = $this->getInput('s_status', '');
        
        // order variables here
        $sort_by = $this->getInput('sort_by', 'game.created_at');
        $order_by = $this->getInput('order_by', DESCENDING);
        
        // search game status
        $games = Game::gameStatus($s_status)
			->gameName($s_name)
			->gameSort($sort_by, $order_by)
			->paginate(PAGINATION_LIMIT);
        // game records
        $this->data["games"] = $games;
        
        // previous search values
        $this->data["s_name"] = $s_name;
        $this->data["s_status"] = $s_status;
        
        // list of status
        $this->data["status"] = getOptionStatus();
        
        // current record number
        $this->data["count"] = $games->getFrom();
        
        // search parameter to the pagination
        $this->data["url_pagination"] = array('sort_by' => $sort_by, 'order_by' => $order_by, 's_name' => $s_name, 's_status' => $s_status);

        // search parameter to the sorting
        $this->data["url_sort"] = array('sort_by' => $sort_by, 'order_by' => getSortOrder($order_by), 
                                        's_name' => $s_name, 's_status' => $s_status,
                                        'page' => $games->getCurrentPage());

        // load the view and pass the game records
        return View::make('setup.game.index')->with('data', $this->data);
    }                                                                               


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		// header and module properties
		$this->data['page_module'] = GAME_MODULE;
		$this->data['page_title'] = GAME_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(GAME_TITLE));
        }

        // get locations
        $this->data["locations"] = Location::locationStatus(ACTIVE)->locationSort('location_name', ASCENDING)->get();

        // get debts
        $this->data["debts"] = Debt::debtStatus(ACTIVE)->debtSort('debt_name', ASCENDING)->get();
        
        // get status
        $this->data["status"] = getOptionStatus();
        
        // load the create form
        return View::make('setup.game.create')->with('data', $this->data);
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
            'game_name' => 'required',
            'location_key' => 'required',
            'game_date' => 'required|date_format:"'.DATE_FORMAT_1,
            'game_time_from' => 'required|validate_time24',
            'game_time_to' => 'required|validate_time24',
            'game_max_players' => 'required|integer|min:1',
            'game_amount' => 'required|numeric',
            'debt_key' => 'required',
            'game_debt_amount' => 'required|numeric',
            'game_announce_date' => 'date_format:"'.DATE_FORMAT_1,
            'game_announce_final_date' => 'date_format:"'.DATE_FORMAT_1,
            'game_status' => 'required',
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
            $data['game_key'] = generateRandomID();
            $data['game_name'] = $this->getInput('game_name', '');
            $data['location_id'] = Location::locationKey($this->getInput('location_key', ''))->pluck('id');
            $data['game_date'] = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $data['game_max_players'] = $this->getInput('game_max_players', '');
            $data['game_amount'] = $this->getInput('game_amount', '');
            $data['debt_id'] = Debt::debtKey($this->getInput('debt_key', ''))->pluck('id');
            $data['game_debt_amount'] = $this->getInput('game_debt_amount', '');
            $data['game_remarks'] = $this->getInput('game_remarks', '');
            $data['game_announce_date'] = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_announce_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $data['game_announce_final_date'] = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_announce_final_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $data['game_status'] = $this->getInput('game_status', '');
            $data['created_by'] = Auth::user()->id;
            
            // create record
            $game = Game::create($data);

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
		$this->data['page_module'] = GAME_MODULE;
		$this->data['page_title'] = GAME_TITLE;
		
        // to preserve previous url, check if the validation failed
        if (!Session::has('danger')) {
            $this->setPreviousListURL(strtolower(GAME_TITLE)); 
        }
        
        // get the selected record
        $game = Game::gameKey($id)->first();
        
        // check if the record really exist
        if (is_null($game)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(GAME_TITLE));
        }

        // get locations
        $this->data["locations"] = Location::locationStatus(ACTIVE)->locationSort('location_name', ASCENDING)->get();

        // get debts
        $this->data["debts"] = Debt::debtStatus(ACTIVE)->debtSort('debt_name', ASCENDING)->get();
		
        // get record
        $this->data["game"] = $game;
        
        // get status
        $this->data["status"] = getOptionStatus();

        // load the show form
        return View::make('setup.game.show')->with('data', $this->data);

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
            'game_name' => 'required',
            'location_key' => 'required',
            'game_date' => 'required|date_format:"'.DATE_FORMAT_1,
            'game_time_from' => 'required|validate_time24',
            'game_time_to' => 'required|validate_time24',
            'game_max_players' => 'required|integer|min:1',
            'game_announce_date' => 'date_format:"'.DATE_FORMAT_1,
            'game_announce_final_date' => 'date_format:"'.DATE_FORMAT_1,
            'game_status' => 'required',
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
            $game = Game::gameKey($id)->first();
            
            // check if the record can be updated
            if (empty($game->id)) {
                // redirect to list page
                Session::flash('danger', SOMETHING_WENT_WRONG);
                return Redirect::to(strtolower(GAME_TITLE));
            }
			
            // fields to be updated
            $game->game_name = $this->getInput('game_name', '');
            $game->location_id = Location::locationKey($this->getInput('location_key', ''))->pluck('id');
            $game->game_date = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $game->game_max_players = $this->getInput('game_max_players', '');
            $game->game_amount = $this->getInput('game_amount', '');
            $game->debt_id = Debt::debtKey($this->getInput('debt_key', ''))->pluck('id');
            $game->game_debt_amount = $this->getInput('game_debt_amount', '');
            $game->game_remarks = $this->getInput('game_remarks', '');
            $game->game_announce_date =  \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_announce_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $game->game_announce_final_date = \Carbon\Carbon::createFromFormat(DATE_FORMAT_1, $this->getInput('game_announce_final_date', DEFAULT_DATE))->format(DB_DATE_FORMAT);
            $game->game_status = $this->getInput('game_status', '');
            $game->updated_by = Auth::user()->id;
            $game->save();
            
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
        $game = Game::gameKey($id)->first();
        
        // check if the record really exist
        if (is_null($game)) {
            // redirect to list page
            Session::flash('danger', SOMETHING_WENT_WRONG);
            return Redirect::to(strtolower(GAME_TITLE));
        }
        
        // store user who deleted the record
        $game->deleted_by = Auth::user()->id;
        $game->save();
        
		// delete record
        $game->delete();

        // redirect to list page
        Session::flash('success', SUCCESS_DELETE);
        return Redirect::to(strtolower(GAME_TITLE));
    }
}
