<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RoomTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('BookingTableSeeder');
	}

}

class RoomTableSeeder extends Seeder {
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Room::truncate();
		Room::create(array(
			'name' => 'Sala grande Officina',
			'location' => 'Treviso',
			'has_video' => 1
		));
		Room::create(array(
			'name' => 'Sala piccola Officina',
			'location' => 'Treviso',
			'has_video' => 0
		));
		Room::create(array(
			'name' => 'Sala piccola Pensatoio',
			'location' => 'Treviso',
			'has_video' => 0
		));
		Room::create(array(
			'name' => 'Sala grande Milano',
			'location' => 'Milano',
			'has_video' => 1
		));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}

class UserTableSeeder extends Seeder {
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		User::truncate();
		User::create(array(
			'email' => 'mrosati@h-art.com',
			'name' => 'Matteo Rosati'
		));
		User::create(array(
			'email' => 'rbutti@h-art.com',
			'name' => 'Roberto Butti'
		));
		User::create(array(
			'email' => 'agabriele@h-art.com',
			'name' => 'Andrea Gabriele'
		));
		User::create(array(
			'email' => 'gnegro@h-art.com',
			'name' => 'Giovanni Negro'
		));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}

class BookingTableSeeder extends Seeder {
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Booking::truncate();
		Booking::create(array(
			'user_id' => 1,
			'room_id' => 1,
			'from' => '2013-12-11 15:00:00',
			'to' => '2013-12-11 16:00:00'
		));
		Booking::create(array(
			'user_id' => 2,
			'room_id' => 1,
			'from' => '2013-12-11 16:00:00',
			'to' => '2013-12-11 16:30:00'
		));
		Booking::create(array(
			'user_id' => 3,
			'room_id' => 2,
			'from' => '2013-12-11 11:00:00',
			'to' => '2013-12-11 12:30:00'
		));
		Booking::create(array(
			'user_id' => 4,
			'room_id' => 3,
			'from' => '2013-12-12 10:00:00',
			'to' => '2013-12-12 14:00:00'
		));
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}