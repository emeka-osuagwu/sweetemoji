<?php

ERROR_REPORTING(E_ALL);
ini_set('display_errors', 1);

include "vendor/autoload.php";


use Slim\Slim;

use Emeka\Candy\Model\BaseModel;

use Emeka\SweetEmoji\Model\User;
use Emeka\SweetEmoji\Model\Emoji;
use Emeka\SweetEmoji\Controller\EmojiController;
use Emeka\SweetEmoji\Controller\AuthController;

$app = new Slim;

//$authMiddleware = new AuthMiddleware();
$authController = new AuthController();
$emojiController = new EmojiController();




$app->get('/auth/login', function () use ($authController){
	echo  $authController->login();
});








/*
| Welcome page
*/
$app->get('/', function (){
	echo "Welcome to Naija Emoji Service";
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
| POST method
*/
$app->post('/emojis', function () use ($emojiController){
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
$app->delete('/emojis/:id', function ($id) use ($emojiController){
	$emojiController->deleteEmoji($id);
});

















$app->run();
