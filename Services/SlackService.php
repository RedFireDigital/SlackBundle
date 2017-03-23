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

use PartFire\SlackBundle\Entity\Repository\SlackMessageRepository;
use PartFire\SlackBundle\Entity\Repository\SlackRepositoryFactory;
use PartFire\SlackBundle\Entity\SlackMessage;
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

    private $slackMessageRepository;


    public function __construct(
        MessageInterface $message,
        ChannelPicker $channelPicker,
        SlackRepositoryFactory $slackMessageRepository
    )
    {
        $this->message = $message;
        $this->channelPicker = $channelPicker;
        $this->slackMessageRepository = $slackMessageRepository;
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

        $newSlackMessage = new SlackMessage();
        $newSlackMessage->setChannel($channel);
        $newSlackMessage->setIcon($icon);
        $newSlackMessage->setMessage($message);

        $this->saveSlackMessage($newSlackMessage);
    }

    public function sendMessageToSlack(SlackMessage $slackMessage)
    {
        try {
            $this->message->send($slackMessage->getMessage(), $slackMessage->getChannel(), $slackMessage->getIcon());
            $slackMessage->setHasSent(true);
        } catch (\Exception $e) {
            $slackMessage->setResponse($e->getMessage());
        }
        $slackMessage->setActioned(true);
        $this->saveSlackMessage($slackMessage);
    }

    private function saveSlackMessage(SlackMessage $slackMessage) : SlackMessage
    {
        return $this->slackMessageRepository->saveAndGetEntity($slackMessage);
    }
}
