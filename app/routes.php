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

// Authentication filter
Route::filter('auth', function ()
{
	if ( ! Config::get('roombooking.auth_enabled') )
	{
		// skip authentication
		return;
	}
	else
	{
		if ( ! Session::has('access_token') || ! Session::has('user') )
		{
			return Redirect::route('auth');
		}
	}
});

Route::get('/auth', array('as' => 'auth', 'uses' => 'AuthController@index'));

Route::get('/', array('before' => 'auth', 'as' => 'home', function()
{
	return Session::get('user');
}));

// Booking resource, filter authentication
Route::group(array('before' => 'auth'), function()
{
	Route::get('/bookings', array('as' => 'all_bookings', 'uses' => 'BookingController@index'));
	Route::post('/bookings', array('as' => 'create_booking', 'uses' => 'BookingController@create'));
	Route::put('/bookings', array('as' => 'update_booking', 'uses' => 'BookingController@update'));
	Route::delete('/bookings', array('as' => 'delete_booking', 'uses' => 'BookingController@destroy'));
});
