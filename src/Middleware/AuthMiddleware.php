<?php

namespace Emeka\SweetEmoji\Middleware;

use Slim\Slim;
use Firebase\JWT\JWT;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;

class AuthMiddleware
{
	public 
	$token,
	$expiry,
	$auth_user;
	
	public function __construct( $app )
	{
		$this->app = $app;
	}

	public function authenticate()
	{
		$app 		= $this->app;
		$request 	= $app->request();
		$response 	= $app->response();
		$response->header("Content-Type", "application/json");
		
		if ( ! $request->headers->get('Authorization') ) 
		{
			return Auth::deny_access("Authorization Token is not set. Please login");
		}
		else
		{			
			$key 						= "example_key";
			$this->token 				= $request->headers->get('Authorization');
			$decoded_jwt 				= JWT::decode($this->token, $key, array('HS512'));
			$decoded_jwt 				= (object) $decoded_jwt;
			$this->expiry 				= $decoded_jwt->exp;
			$this->auth_user 			= User::where('username', $decoded_jwt->data->username);
			$this->auth_user 			=  json_decode($this->auth_user, true); 
			$this->auth_user 			= $this->auth_user[0];
			return $this->auth_user['username'];
		}
	}
}
