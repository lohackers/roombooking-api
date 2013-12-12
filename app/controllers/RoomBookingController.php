<?php

class RoomBookingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		if ( Input::get('upcoming') )
		{
			return Booking::with('user')
				->where('room_id', '=', $id)
				->where('from', '>=', DB::raw('NOW()'))
				->where('from', '<=', DB::raw('NOW() + INTERVAL 15 MINUTE'))
				->get();
		}

		if ( Input::get('onair') )
		{
			$q = Booking::with('user')
				->where('room_id', '=', $id)
				->where(DB::raw('NOW()'), '>=', DB::raw('`from`'))
				->where(DB::raw('NOW()'), '<=', DB::raw('`to`'))
				->get();

			$queries = DB::getQueryLog();
			$last_query = end($queries);

			return $q;
		}

		return Booking::with('user')
			->where('room_id', '=', $id)
			->get();
	}

}
