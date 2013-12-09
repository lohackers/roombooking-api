<?php

class BookingController extends \BaseController {

	// GET: list all bookings
	public function index()
	{
		return Booking::with(array('user', 'room'))->get();
	}

	// POST: create a new booking
	public function create()
	{
		$booking = new Booking(Input::all());

		// Try to save booking
		try
		{
			$booking->save();
			return $booking;
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

		$booking->update(Input::all());

		return Booking::with(array('user', 'room'))->find(Input::get('id'));
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

		return Response::make('Deleted', 200);
	}

}