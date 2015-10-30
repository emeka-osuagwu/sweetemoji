<?php

namespace spec\Emeka\SweetEmoji\Auth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Emeka\SweetEmoji\Auth\Auth');
    }
}
