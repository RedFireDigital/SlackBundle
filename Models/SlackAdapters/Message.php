<?php
/**
 * Created by Carl Owens (carl@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Copyright © 2016 PartFire Ltd. All rights reserved.
 *
 * User:    Carl Owens
 * Date:    22/12/2016
 * Time:    20:48
 * File:    Message.php
 **/

namespace PartFire\SlackBundle\Models\SlackAdapters;

use PartFire\SlackBundle\Models\MessageInterface;
use ThreadMeUp\Slack\Client as SlackClient;

class Message implements MessageInterface
{
    /**
     * @var
     */
    protected $slackToken;

    /**
     * @var
     */
    protected $slackTeam;

    /**
     * @var
     */
    protected $slackUsername;

    /**
     * Message constructor.
     * @param $slackToken
     * @param $slackTeam
     * @param $slackUsername
     */
    public function __construct($slackToken, $slackTeam, $slackUsername)
    {
        $this->slackToken = $slackToken;
        $this->slackTeam = $slackTeam;
        $this->slackUsername = $slackUsername;
    }

    /**
     * @param $message
     * @param $channel
     * @param $icon
     * @return bool
     */
    public function send($message, $channel, $icon)
    {
        $config = [
            'token' => $this->slackToken,
            'team' => $this->slackTeam,
            'username' => $this->slackUsername,
            'icon' => $icon,
            'parse' => ''
        ];
        $slackClient = new SlackClient($config);
        $chat = $slackClient->chat($channel);
        return $chat->send($message);
    }
}
