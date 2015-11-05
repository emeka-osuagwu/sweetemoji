<?php

namespace Emeka\SweetEmoji\Auth;

use Slim\Slim;

class Auth 
{
	public static function deny_access($message)
	{
		$app = Slim::getInstance();
		$response = $app->response();
		$responseArray['error'] = $message;
		$responseArray['status'] = $response->status(401);
		$response->body(json_encode($responseArray));
		$app->stop();
		return $response;
	}
} 