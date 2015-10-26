<?php

namespace spec\Bendozy\NaijaEmoji\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmojiControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bendozy\NaijaEmoji\Controller\EmojiController');
    }
}
