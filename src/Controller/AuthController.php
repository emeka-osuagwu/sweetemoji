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

			$user = User::where('username', $username);
				
			if( $user->password == $password) {
				return Auth::deny_access("Incorrect Authentication Details");
			}

			$responseArray['username'] = $user->username;
			$responseArray['token'] = bin2hex(openssl_random_pseudo_bytes(16)); //generate a random token

			$tokenExpiration = date('Y-m-d H:i:s', strtotime('+1 hour'));//the expiration date will be in one hour from the current moment

			$updatedUser = $user;
			$updatedUser->token = $responseArray['token'];
			$updatedUser->expiry = $tokenExpiration;
			$updatedUser->save(); 

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