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

Route::get('/auth', array('as' => 'auth.index', 'uses' => 'AuthController@index'));

// Booking resource, filter authentication
Route::group(array('before' => 'auth'), function()
{
	// bookings full resource
	Route::resource('bookings', 'BookingController');

	// get bookings on a room
	Route::get('/rooms/{id}/bookings', array('as' => 'roombooking.index', 'uses' => 'RoomBookingController@index'))->where('id', '[0-9]+');
});
