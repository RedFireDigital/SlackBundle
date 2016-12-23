<?php
/**
 * Created by Carl Owens (carl@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Copyright © 2016 PartFire Ltd. All rights reserved.
 *
 * User:    Carl Owens
 * Date:    22/12/2016
 * Time:    20:43
 * File:    SlackService.php
 **/

namespace PartFire\SlackBundle\Services;

use PartFire\SlackBundle\Models\ChannelPicker;
use PartFire\SlackBundle\Models\MessageInterface;

class SlackService
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var ChannelPicker
     */
    protected $channelPicker;

    /**
     * SlackService constructor.
     * @param MessageInterface $message
     * @param ChannelPicker $channelPicker
     */
    public function __construct(MessageInterface $message, ChannelPicker $channelPicker)
    {
        $this->message = $message;
        $this->channelPicker = $channelPicker;
    }

    /**
     * @param $message
     * @param string $channel
     * @param string $icon
     * @return mixed
     */
    public function sendMessage($message, $channel = '#random', $icon = ':speech_balloon:')
    {
        $channel = $this->channelPicker->getChannel($channel);
        return $this->message->send($message, $channel, $icon);
    }
}
