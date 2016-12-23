<?php

namespace spec\PartFire\SlackBundle\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChannelPickerSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('PartFire\SlackBundle\Models\ChannelPicker');
    }

    function it_should_return_test_channel()
    {
        $this->beConstructedWith('dev');
        $this->getChannel('some-channel')->shouldBe('dev-tests');
    }

    function it_should_return_actual_channel()
    {
        $this->beConstructedWith('prod');
        $this->getChannel('some-channel')->shouldBe('some-channel');
    }
}
