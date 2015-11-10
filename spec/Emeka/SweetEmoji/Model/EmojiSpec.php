<?php

namespace spec\Emeka\SweetEmoji\Model;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Emeka\SweetEmoji\Model\Emoji;

class EmojiSpec extends ObjectBehavior
{
	private $emoji;
	
	public function let()
	{
		$this->emoji = new Emoji;
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Emeka\SweetEmoji\Model\Emoji');
    }

}
