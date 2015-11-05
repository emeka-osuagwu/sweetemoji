<?php

ERROR_REPORTING(E_ALL);
ini_set('display_errors', 1);
include "vendor/autoload.php";

use Slim\Slim;
use Emeka\Candy\Model\BaseModel;
use Emeka\SweetEmoji\Model\User;
use Emeka\SweetEmoji\Model\Emoji;
use Emeka\SweetEmoji\Controller\AuthController;
use Emeka\SweetEmoji\Middleware\AuthMiddleware;
use Emeka\SweetEmoji\Controller\EmojiController;

$app = new Slim;
$authController 	= new AuthController();
$authMiddleware 	= new AuthMiddleware();
$emojiController 	= new EmojiController();

$authenticated = function () use ($authMiddleware){
	$authMiddleware->authenticate();
};

$app->get('/', function() 
{
	echo "welcome home";
});

$app->post('/auth/login', function() use ($authController)
{
	$authController->login();
});

$app->get('/auth/logout', function() use ($authController)
{
	echo "logout";
});

$app->post('/emojis', function()
{
	echo "creating";
});

$app->get('/emojis', function()
{
	echo "get all";
});

$app->get('/emojis', function()
{
	echo "get all";
});

$app->get('/emojis/:id', function($id)
{
	echo "get one";
});

$app->post('/emojis/:id', function($id)
{
	echo "update 1";
});

$app->delete('/emojis/:id', function($id)
{
	echo "delete 1";
});









$app->run();


