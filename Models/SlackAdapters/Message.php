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

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use PartFire\SlackBundle\Models\MessageInterface;
use Nexy\Slack\Client as SlackClient;

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

        $slackClient = new SlackClient(
            Psr18ClientDiscovery::find(),
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
            $this->slackUsername,
            [
                'username' => $this->slackUsername,
                'channel' => $channel,
                'link_names' => true
            ]
        );

        $slackClient->send($message);
        return true;
    }
}
