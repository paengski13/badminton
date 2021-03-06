<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    App::singleton('shareView', function(){
        $shareView = array("status" => array("A" => array("Active", "fa fa-eye"),
                                             "I" => array("Inactive", "fa fa-eye-slash"),
                                             "L" => array("Locked", "fa fa-lock"),
                                             "X" => array("Closed", "fa fa-power-off"),
                                             "P" => array("Pause", "fa fa-pause")),
                           "order" => array("asc"  => array("text" => "Ascending", 
															"class" => "fa fa-sort-up"),
                                            "desc" => array("text" => "Descending", 
															"class" => "fa fa-sort-down"),
                                            ""     => array("text" => "", 
															"class" => "fa fa-sort")),
                           "answer" => array("yes" => "Y",
                                             "no"  => "N"),
                           "gender" => array("male" => "M",
                                             "female"  => "F"),
                           "date_format_1" => "d M Y",
                           "invalid_date" => "0000-00-00",
                           
                           "delimeter" => "XdI_IbX",
                     );
        return $shareView;
    });

    // If you use this line of code then it'll be available in any view
    // as $shareView but you may also use app('shareView') as well
    View::share('shareView', app('shareView'));
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic('employee_username');
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});