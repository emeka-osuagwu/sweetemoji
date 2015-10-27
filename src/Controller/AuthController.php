<?php

namespace Emeka\SweetEmoji\Controller;

use Slim\Slim;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;
use Emeka\ORM\Exceptions\ModelNotFoundException;

class AuthController
{
	public function login()
	{
		$app = Slim::getInstance();
		$response = $app->response();
		$response->header("Content-Type", "application/json");

		$username = $app->request()->params('username');
		$password = $app->request()->params('password');

		if( ! isset($username) ) {
			return Auth::deny_access("Username is null");
		}

		if(! isset($password)) {
			return Auth::deny_access("Password is null");
		}

		try {
			$username = htmlentities(trim($username));
			$password = htmlentities(trim($password));

			$database_user = User::where('username', $username);
			$database_user = json_decode($database_user, true)[0];
			
			if( $database_user['password'] == $password) 
			{
				return Auth::deny_access("Incorrect Authentication Details");
			}

			$user = new User;
			$tokenExpiration 			= date('Y-m-d H:i:s', strtotime('+1 hour'));
			$responseArray['token'] 	= bin2hex(openssl_random_pseudo_bytes(16));
			$user->id 			= $database_user['id'];
			$user->token 		= $responseArray['token'];
			$user->expiry  		= $tokenExpiration;
			$user->username 	= $database_user['username'];
			$user->password 	= $database_user['password'];
			
			
			
			User::save(); 

			$response->status(200);
			$response->body(json_encode($responseArray));

		} catch(ModelNotFoundException $e) {
			$response = Auth::deny_access("Incorrect Authentication Details");
		}

		return $response;
	}

	public function logout()
	{
		$app = Slim::getInstance();
		$token = $app->request->headers->get('Authorization');
		$response = $app->response();
		$response->header("Content-Type", "application/json");

		$user = User::findByToken($token);
		$user->token = "";
		$user->token_expire = "";
		$user->save();

		$responseArray['message'] = "User is successfully logged out";

		$response->status(200);
		$response->body(json_encode($responseArray));

		return $response;
	}

} 