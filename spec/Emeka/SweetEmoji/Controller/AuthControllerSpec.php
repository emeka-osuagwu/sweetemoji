<?php

namespace spec\Emeka\SweetEmoji\Controller;

use Slim\Http\Response;
use Slim\Slim;
use Slim\Environment;
use PhpSpec\ObjectBehavior;

class AuthControllerSpec extends ObjectBehavior
{
	private $app;

	public function let()
	{
		$this->app = new Slim();

	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Emeka\SweetEmoji\Controller\AuthController');
	}

	function it_can_be_logged_in_to()
	{
		$this->app->environment = Environment::mock([
			'REQUEST_METHOD' => 'POST',
			'REQUEST_URI' => '/auth/login',
			'QUERY_STRING' => 'username=test&password=password'
		]);
	}
}
