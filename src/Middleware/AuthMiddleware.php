<?php

namespace Emeka\SweetEmoji\Middleware;

use Slim\Slim;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;

class AuthMiddleware
{
	private $auth;
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
		
		if( ! $request->headers->get('Authorization') ) 
		{
			return Auth::deny_access("Authorization Token is not set. Please login");
		}
		
	}
}
