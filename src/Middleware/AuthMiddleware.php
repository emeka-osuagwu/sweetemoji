<?php

namespace Emeka\Sweetemoji\Middleware;

use Slim\Slim;
use Emeka\EmojiController\Auth\Auth;
use Emeka\EmojiController\Model\User;

class AuthMiddleware
{
	private $auth;

	public function authenticate()
	{
		$app = Slim::getInstance();
		$token = $app->request->headers->get('Authorization');
		$response = $app->response();
		$response->header("Content-Type", "application/json");

		if(! isset($token)) {
			return Auth::deny_access("Authorization Token is not set. Please login");
		}

		try 
		{
			$token = htmlentities(trim($token));
			$user = User::findByToken($token);

			if($user->token_expire < date('Y-m-d H:i:s')) 
			{
				return Auth::deny_access("Authorization Token has expired. Please login again.");
			}

			$user->token_expire = date('Y-m-d H:i:s', strtotime('+1 hour'));
			$user->save();

		} 
		catch(ModelNotFoundException $e) 
		{
			return Auth::deny_access("Authorization Token is invalid.");
		}
	}
}