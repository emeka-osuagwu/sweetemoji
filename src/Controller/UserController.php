<?php

namespace Emeka\SweetEmoji\Controller;

use Slim\Slim;
use PDOException;
use Firebase\JWT\JWT;
use Slim\Http\Response;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;
use Emeka\Fetcher\Helpers\Helper;
use Emeka\SweetEmoji\Exceptions\ModelNotFoundException;

class UserController
{
	public function __construct($app)
	{
		$this->app = $app;
	}

	public function register()
	{
		$app 			= $this->app;
		$request 		= $app->request();
		$response 		= $app->response();
		$response->headers->set('Content-Type', 'application/json');
		$username 		= $request->params('username');
		$password 		= $request->params('password');

		if ( ! isset($password) || empty($password) ) 
		{
			$responseArray['message'] 	= "password not set";
			$responseArray['status'] 	= 400;
		}
		elseif ( ! isset($username) || empty($username) ) 
		{
			$responseArray['status'] 	= 400;	
			$responseArray['message'] 	= "username not set";
		}
		else
		{
			$user = new User;
			$user->username = $username;
			$user->password = $password;
			$user->save();

			$responseArray['status'] 	= 200;
			$responseArray['massage'] 	= "Registration Successful";
		}
		$response->body(json_encode($responseArray));
		return $response;
	}
} 



