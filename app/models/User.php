<?php

class User extends Eloquent {
	public $timestamps = false;
	public static $unguarded = true;

	public function bookings () {
		return $this->hasMany('Booking');
	}
}