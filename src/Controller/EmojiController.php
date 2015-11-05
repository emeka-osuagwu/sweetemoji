<?php

namespace Emeka\SweetEmoji\Controller;

use Slim\Slim;
use PDOException;
use Firebase\JWT\JWT;
use Slim\Http\Response;
use Emeka\SweetEmoji\Auth\Auth;
use Emeka\SweetEmoji\Model\User;
use Emeka\SweetEmoji\Model\Emoji;
use Emeka\Fetcher\Helpers\Helper;
use Emeka\SweetEmoji\Exceptions\ModelNotFoundException;


class EmojiController
{
	public function __construct($app)
	{
		$this->app = $app;
	}
	
	public function findEmoji($id)
	{
		$app = Slim::getInstance();
		$response = $app->response();
		$response->headers->set('Content-Type', 'application/json');

		try 
		{
			$emoji = Emoji::find($id);
			$response->body($emoji);
		} 
		catch(PDOException $e) 
		{
			$response->status(404);
			$response->body(json_encode(
			[
				'status' => 401,
				'error' => 'Emoji not found for the given id'
			]));
		}
		return $response;
	}

	public function deleteEmoji($id)
	{
		$app = Slim::getInstance();
		$response = $app->response();
		$response->headers->set('Content-Type', 'application/json');

		try 
		{
			Emoji::find($id);
			Emoji::delete($id);
			$response->body(json_encode(['message' => "Emoji with the given id has been deleted"]));
		} 
		catch(ModelNotFoundException $e) 
		{
			$response->status(404);
			$response->body(json_encode(['error' => 'Emoji not found for the given id']));
		}
		return $response;
	}

	public function all()
	{
		$app = Slim::getInstance();
		$response = $app->response();
		$response->headers->set('Content-Type', 'application/json');
		echo $emojis_class = Emoji::all();
	}

	public function addEmoji()
	{
		$app 		= $this->app;
		$request 	= $app->request();
		$token 		= $request->headers->get('Authorization');
		$tag 		= $request->params('tag');
		$title 		= $request->params('title');
		$image 		= $request->params('image');
		
		if(! isset($title)) {
			return Auth::deny_access("Emoji name is null");
		}

		if(! isset($image)) {
			return Auth::deny_access("Emoji character value is null");
		}

		if(! isset($tag)) {
			return Auth::deny_access("Emoji category is null");
		}

		$response = $app->response();
		$response->header("Content-Type", "application/json");
		$token 			= $request->headers->get('Authorization');
		$key 			= "example_key";
		$decoded_jwt 	= JWT::decode($token, $key, array('HS512'));
		$decoded_jwt 	= (object) $decoded_jwt;
		$user 			= User::where('username', $decoded_jwt->data->username);

		if (  count($user) > 0 ) 		
		{
			$responseArray['status'] 	= "Emoji has been successfully created";
			$responseArray['message']	= 200; 	
			$response->status(200);
			$response->body(json_encode($responseArray));
			$emoji = new Emoji;
			$emoji->title = $title;
			$emoji->image = $image;
			$emoji->tag = $tag;
			$emoji::save();
			return $response;
		}
		return "Invalid User";	
	}

	public function updateEmoji($id)
	{
		$app = Slim::getInstance();
		$request = $app->request();
		$response = $app->response();
		$response->header("Content-Type", "application/json");
		$tag = $request->params('tag');
		$title = $request->params('title');
		$image = $request->params('image');
		

		try 
		{
			$emoji 		= new Emoji;
			$emoji->id 	= $id;
			
			if( isset ( $tag ) ) 
			{
				$emoji->tag = $tag;
			}

			if(isset($image)) 
			{
				$emoji->image = $image;
			}

			if(! isset($title)) 
			{
				$emoji->title = $title;
			}

			$emoji::save();
			$responseArray['status'] 	= 200;
			$responseArray['message'] 	= "Emoji has been successfully updated";
			$response->status(200);
			$response->body(json_encode($responseArray));

		} catch(ModelNotFoundException $e) {
			$response->body(json_encode(['error' => 'Emoji not found for the given id']));
			$response->status(404);
		}

		return $response;
	}

	public function buildResult(Emoji $emoji)
	{
		return [
			"id" => $emoji->id,
			"name" => $emoji->name,
			"char" => $emoji->emoji_char,
			"category" => $emoji->category,
			"keywords" => explode(",", $emoji->keywords),
			"date_created" => $emoji->date_created,
			"date_modified" => $emoji->date_modified,
			"created_by" => User::find($emoji->created_by)->username
		];
	}	
} 
