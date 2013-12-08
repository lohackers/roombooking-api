<?php

class Room extends Eloquent {
	public $timestamps = false;

	public function bookings () {
		return $this->hasMany('Booking');
	}
}
