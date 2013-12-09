<?php

class BookingController extends \BaseController {

	// GET: list all bookings
	public function index()
	{
		switch ( Request::format() )
		{
			case 'json':
			return Booking::with(array('user', 'room'))->get();

			case 'html':
			return View::make('bookings/index')->with(array('bookings' => Booking::with(array('user', 'room'))->get()));

			default:
			return Response::make('Content type not acceptable', 406);
		}
	}

	public function edit()
	{
		return View::make('bookings/edit')->with(array(
			'rooms' => Room::lists('name', 'id'),
			'users' => User::lists('email', 'id')
		));
	}

	// POST: create a new booking
	public function create()
	{
		$booking = new Booking(Input::except('_token'));

		// Try to save booking
		try
		{
			$booking->save();

			switch ( Request::format() )
			{
				case 'html':
				return Redirect::route('all_bookings');

				case 'json':
				return $booking;

				default:
				return Response::make('Content type not acceptable', 406);
			}
		}
		catch (\Exception $e)
		{
			return Response::make('Invalid input data', 400);
		}
	}

	// PUT: update an existing booking
	public function update()
	{
		$booking = Booking::find(Input::get('id'));

		if ( ! $booking )
		{
			return Response::make('Booking not found', 404);
		}

		try
		{
			$booking->update(Input::all());
			return Booking::with(array('user', 'room'))->find(Input::get('id'));
		}
		catch (\Exception $e)
		{
			return Response::make('Invalid data', 400);
		}
	}

	public function destroy()
	{
		$booking = Booking::find(Input::get('id'));

		if ( ! $booking )
		{
			return Response::make('Booking not found', 404);
		}
		else
		{
			$booking->delete();
		}

		switch ( Request::format() )
		{
			case 'json':
			return Response::make('Deleted', 200);

			case 'html':
			return Redirect::route('all_bookings');

			default:
			return Response::make('Content type not acceptable', 406);
		}
	}

}