<?php

namespace spec\Bendozy\NaijaEmoji\Auth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bendozy\NaijaEmoji\Auth\Auth');
    }
}
