<?php

namespace spec\Emeka\SweetEmoji\Middleware;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthMiddlewareSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Emeka\SweetEmoji\Middleware\AuthMiddleware');
    }
}
