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
		$booking = Booking::create(Input::all());
		return $booking;
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