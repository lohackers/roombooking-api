<?php

class RoomBookingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return Booking::with('user')
			->where('room_id', '=', $id)
			->get();
	}

}
