<?php

namespace Emeka\SweetEmoji\Controller;

use Slim\Slim;
use Firebase\JWT\JWT;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;
use Emeka\SweetEmoji\Auth\Config;
use Emeka\ORM\Exceptions\ModelNotFoundException;

class AuthController
{
	public function __construct($app)
	{
		$this->app 		= $app;
		$this->config 	= new Config;
	}

	/*
	| Method Login
	| login's in user and generate a token on login
	*/
	public function login()
	{
		$response = $this->app->response();
		$response->header("Content-Type", "application/json");
		$username = $this->app->request()->params('username');
		$password = $this->app->request()->params('password');

		if( ! isset($username) ) 
		{
			return Auth::deny_access("Username is null");
		}

		if( ! isset($password)) 
		{
			return Auth::deny_access("Password is null");
		}

		$username 		= htmlentities(trim($username));
		$password 		= htmlentities(trim($password));
		$database_user 	= User::where('username', $username);
		$database_user 	=  json_decode($database_user, true);
		
		if ( empty($database_user) ) 
		{
			return [
				'status' 	=> 400,
				'message' 	=> 'username doesn\'t'
			];	
		}

		$database_user =  $database_user[0];
		
		if( $database_user['password'] == md5($password) ) 
		{

			$key 	= $this->config->jwt_key();
			$token 	= 
			[
				"iss"	=> $this->config->jwt_issuer(),
				"iat"	=> $this->config->jwt_issuer_at(),
				"nbf"	=> $this->config->jwt_not_before(),
				"exp"	=> $this->config->jwt_expiration_time(),
				"data"	=> 
				[
					"username"	=> $database_user['username']
				]
			];
			$encode_jwt 	= JWT::encode($token, $key, 'HS512');
			$responseArray 	= 
			[
				"token"		=> $encode_jwt,
				"status" 	=> 200
			];
			$response->status(200);
			$response->body(json_encode($responseArray));
			return $response;
		}
		else 
		{
			return Auth::deny_access("Incorrect Authentication Details");
		}
	}
	
	/*
	| Method Logout
	| logout's in user 
	*/
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