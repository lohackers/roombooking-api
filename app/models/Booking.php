<?php

class Booking extends Eloquent {
	public static $unguarded = true;

	public function user () {
		return $this->belongsTo('User');
	}

	public function room () {
		return $this->belongsTo('Room');
	}
}
