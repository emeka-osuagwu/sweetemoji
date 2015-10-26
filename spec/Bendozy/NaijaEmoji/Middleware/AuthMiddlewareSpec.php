<?php

namespace spec\Bendozy\NaijaEmoji\Middleware;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthMiddlewareSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bendozy\NaijaEmoji\Middleware\AuthMiddleware');
    }
}
