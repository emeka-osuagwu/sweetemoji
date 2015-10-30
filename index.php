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

$app->post('/auth/login', function () use ($authController){
	$authController->login();
});

$app->post('/auth/logout', $authenticated, function () use ($authController){
	$authController->logout();
});

/*
| Welcome page
*/
$app->get('/', function (){
	echo "SweetEmoji Emoji";
});


/*
| "/emojis" get all emoji from the database
| GET method
*/
$app->get('/emojis', function () use ($emojiController){
	$emojiController->all();
});


/*
| "/emojis" create new emoji
| PUT method
*/
$app->put('/emojis', function () use ($emojiController){
	$emojiController->addEmoji();
});


/*
| "/emojis" create new emoji
| PATCH method
*/
$app->patch('/emojis/:id', function ($id) use ($emojiController){
	$emojiController->updateEmoji($id);
});


/*
| "/emojis" find an emoji by id
| POST method
*/
$app->post('/emojis/:id', function ($id) use ($emojiController){
	$emojiController->findEmoji($id);
});


/*
| "/emojis/:id" find and delete an emoji by id
| DELETE method
*/
$app->delete('/emojis/:id', $authenticated, function ($id) use ($emojiController){
	$emojiController->deleteEmoji($id);
});


$app->run();
