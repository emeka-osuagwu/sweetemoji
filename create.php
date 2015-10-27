CREATE TABLE USERS(
   ID 			  SERIAL PRIMARY KEY  NOT NULL,
   USERNAME           TEXT  UNIQUE  NOT NULL,
   PASSWORD       CHAR(50)    NOT NULL,
   TOKEN		     CHAR(50)  NULL,
   EXPIRY		  DATE NULL
);

INSERT INTO USERS ( USERNAME, PASSWORD ) VALUES ( 'bobo', 'pass');
INSERT INTO USERS ( NAME, PASSWORD, TOKEN, EXPIRY) VALUES ( 'bobo', 'pass');

CREATE TABLE EMOJIS(
   ID 			  SERIAL PRIMARY KEY  NOT NULL,
   TITLE		  CHAR(50) NOT  NULL,
   TAG			  CHAR(50) NOT  NULL,
   IMAGE		  CHAR(50) NOT NULL
);

CREATE TABLE EMOJIS(
   ID 			  SERIAL PRIMARY KEY  NOT NULL,
   TITLE          TEXT  UNIQUE  NOT NULL,
   TAG       	  CHAR(50)    NOT NULL,
   IMAGE		  CHAR(50)  NOT NULL
);


INSERT INTO EMOJIS ( TITLE, TAG, IMAGE ) VALUES ( 'HappyFace', 'dfvdfvdf', '1.png');


$data = new Fetch('select * from users');
var_dump($data->fetchAssoc());







//use Slim\Slim;
//use Emeka\SweetEmoji\Model\User;



//$app = new Slim();
// $user = New User;
// echo $user->all('bobo');
















// $app->get('/login/:username/:password', function ($username, $password) {  
// 	$user = New User;
// 	//$user->login($username, $password);
// 	echo $user->checkUserExsist('Teddy');

// });













// $app->get('/user/:id', function ($id) {  
// 	$user = New User;
// 	$user->find ($id);
// });


// $app->get('/emoji/', function () {  
// 	$user = New User;
// 	$user->all();
// });

// $app->run();


















 // function getToken()
 //    {
 //        $token = bin2hex(openssl_random_pseudo_bytes(16));
 //        $tokenExpire = date('Y-m-d H:i:s', strtotime('+ 1 hour'));
 //        return json_encode([
 //          'expiry'=>$tokenExpire,
 //          'token' => $token
 //        ]);
 //    }


 //    var_dump(getToken());


