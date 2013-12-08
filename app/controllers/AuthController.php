<?php

use OAuth2\OAuth2;
use OAuth2\Token_Access;
use OAuth2\Exception as OAuth2_Exception;

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Session::has('access_token') ) {
			return Redirect::route('home');
		}

		$provider = OAuth2::provider('google', array(
			'id' => Config::get('roombooking.client_id'),
			'secret' => Config::get('roombooking.client_secret'),
		));

		if ( ! isset($_GET['code'])) return $provider->authorize();

		try
		{
			$params = $provider->access($_GET['code']);
			$token = new Token_Access(array(
				'access_token' => $params->access_token
			));

			$user = $provider->get_user_info($token);

			// put user in session
			Session::put('access_token', $token);
			Session::put('user', $user);

			// Save user to database
			if ( ! User::where('email', '=', $user['email'])->count() )
			{
				User::create(array(
					'email' => $user['email'],
					'name' => $user['name']
				));
			}

			return Redirect::route('home');
		}

		catch (OAuth2_Exception $e)
		{
			show_error('That didnt work: '.$e);
		}

	}
}