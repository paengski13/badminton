<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// regex format when passing parameters
Route::pattern('uuid', '[0-9]{6}[0-9a-f]{13}');
#Route::pattern('template_type', '[a-z_]+');


/*** Session ****/
// index URL
Route::get('', array('uses' => 'SessionController@showLogin'));
Route::get('/', array('uses' => 'SessionController@showLogin'));

// route to show the login form
Route::get('login', array('uses' => 'SessionController@showLogin'));

// route to login request
Route::post('login', array('uses' => 'SessionController@requestLogin'));

// route to process the logout
Route::get('logout', array('uses' => 'SessionController@requestLogout'));

// route to home page
Route::get('home', array('uses' => 'SessionController@showHome'));
/*** End Session ****/

Route::get('my_account/info', array('uses' => 'MyAccountController@getMyInfo'));
Route::put('my_account/info/update', array('uses' => 'MyAccountController@updateMyInfo'));
Route::put('my_account/info/upload', array('uses' => 'MyAccountController@uploadPhoto'));
Route::get('my_account/password', array('uses' => 'MyAccountController@viewChangePassword'));
Route::put('my_account/password/update', array('uses' => 'MyAccountController@changePassword'));

Route::resource('level', 'LevelController');
Route::resource('rank', 'RankController');
Route::resource('tournament', 'TournamentController');
Route::resource('user', 'UserController');
Route::get('user_invite', 'UserController@createInvite');
Route::post('user_invite', 'UserController@sendInvite');
Route::get('confirm_invite/{uuid}', 'UserController@processInvite');
Route::post('confirm_invite/{uuid}', 'UserController@confirmInvite');
Route::post('user_contact/{uuid}', 'UserContactController@deleteContact');
Route::post('user/photo/upload', array('uses' => 'UserController@uploadPhoto'));
Route::put('user/photo/upload', array('uses' => 'UserController@uploadPhoto'));
Route::resource('debt', 'DebtController');
Route::resource('location', 'LocationController');
Route::resource('game', 'GameController');

/*** View Composer ****/
View::composer('*', function($view)
{
    $level_access = NO;
    $rank_access = NO;
    $tournament_access = NO;
    $user_access = NO;
    $debt_access = NO;
    $location_access = NO;
    $game_access = NO;
	
	if (Auth::check()) {
		foreach (Auth::user()->access->toArray() as $record) {
            if ($record['access_name'] == LEVEL_TITLE) {
                $level_access = YES;
            }
            
            if ($record['access_name'] == RANK_TITLE) {
                $rank_access = YES;
            }
            
            if ($record['access_name'] == TOURNAMENT_TITLE) {
                $tournament_access = YES;
            }
            
            if ($record['access_name'] == USER_TITLE) {
                $user_access = YES;
            }
            
            if ($record['access_name'] == DEBT_TITLE) {
                $debt_access = YES;
            }
            
            if ($record['access_name'] == LOCATION_MODULE) {
                $location_access = YES;
            }
            
            if ($record['access_name'] == GAME_MODULE) {
                $game_access = YES;
            }
		}
		
		// determine if currently logged-in user is an admin or normal user
        if (Auth::user()->user_admin == YES)  {
			$view->with('level_access', YES);
			$view->with('rank_access', YES);
			$view->with('tournament_access', YES);
			$view->with('user_access', YES);
			$view->with('debt_access', YES);
			$view->with('location_access', YES);
			$view->with('game_access', YES);
			
		} else {
			$view->with('level_access', $level_access);
			$view->with('rank_access', $rank_access);
			$view->with('tournament_access', $tournament_access);
			$view->with('user_access', $user_access);
			$view->with('debt_access', $debt_access);
			$view->with('location_access', $location_access);
			$view->with('game_access', $game_access);
			
		}
	}
    
});
/*** End View Composer ****/