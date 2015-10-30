<?php

namespace spec\Emeka\SweetEmoji\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmojiSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Emeka\SweetEmoji\Model\Emoji');
    }
}
