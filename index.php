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
$authController     = new AuthController($app);
$authMiddleware     = new AuthMiddleware($app);
$emojiController    = new EmojiController($app);



$authenticated = function () use ($authMiddleware){
    $authMiddleware->authenticate();
};

$app->get('/auth/login', function () use ($authController){
    $authController->login();
});

$app->get('/auth/logout', $authenticated, function () use ($authController){
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
$app->post('/emojis', $authenticated, $authenticated, function () use ($emojiController){
    $emojiController->addEmoji();
});


/*
| "/emojis" create new emoji
| PATCH method
*/
$app->post('/emojis/:id', $authenticated, function ($id) use ($emojiController){
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
