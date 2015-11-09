<?php

namespace spec\Emeka\SweetEmoji\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Emeka\SweetEmoji\Controller\UserController');
    }
}
