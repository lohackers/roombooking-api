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

	// Create a new booking
	public function create()
	{
		return View::make('bookings/create')->with(array(
			'rooms' => Room::lists('name', 'id'),
			'users' => User::lists('email', 'id')
		));
	}

	public function edit($id)
	{
		$booking = Booking::find($id);

		if ( ! $booking )
		{
			return Response::make('Booking not found', 404);
		}

		return View::make('bookings.edit')->with(array(
			'booking' => $booking,
			'rooms' => Room::lists('name', 'id'),
			'users' => User::lists('email', 'id')
		));
	}

	// POST: create a new booking
	public function store()
	{
		$booking = new Booking(Input::except('_token'));

		// Try to save booking
		try
		{
			$booking->save();

			switch ( Request::format() )
			{
				case 'html':
				return Redirect::route('bookings.index');

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
	public function update($id)
	{
		$booking = Booking::find($id);

		if ( ! $booking )
		{
			return Response::make('Booking not found', 404);
		}

		try
		{
			$booking->update(Input::except(array('_method', '_token')));
			return Redirect::route('bookings.edit', $id);
		}
		catch (\Exception $e)
		{
			return Response::make('Invalid data', 400);
		}
	}

	public function destroy($id)
	{
		$booking = Booking::find($id);

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
			return Redirect::route('bookings.index');

			default:
			return Response::make('Content type not acceptable', 406);
		}
	}

}