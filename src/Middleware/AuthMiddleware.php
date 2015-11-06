<?php

namespace Emeka\SweetEmoji\Middleware;

use Slim\Slim;
use Firebase\JWT\JWT;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;

class AuthMiddleware
{
	protected 
	$token,
	$expiry,
	$auth_user;
	
	public function __construct($app)
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
			$token 			= $request->headers->get('Authorization');
			$key 			= "example_key";
			$decoded_jwt 	= JWT::decode($token, $key, array('HS512'));
			$decoded_jwt 	= (object) $decoded_jwt;
			$user 			= User::where('username', $decoded_jwt->data->username);
		}
	}
	
}
