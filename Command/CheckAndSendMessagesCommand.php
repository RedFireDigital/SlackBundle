<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    23/03/17
 * Time:    01:37
 * Project: fruitful-property-investments
 * File:    CheckAndSendMessagesCommand.php
 *
 **/

namespace PartFire\SlackBundle\Command;

use PartFire\SlackBundle\Entity\Repository\SlackMessageRepository;
use PartFire\SlackBundle\Entity\Repository\SlackRepositoryFactory;
use PartFire\SlackBundle\Services\SlackService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PartFire\CommonBundle\Services\Output\Cli\ConsoleOutput;

class CheckAndSendMessagesCommand extends ContainerAwareCommand
{
    private $output;

    private $slackSendDelaySeconds = 1;

    protected function configure()
    {
        $this
            ->setName('partfire:slack:check-and-send')
            ->setDescription('Checks for any slack messages, and sends them')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $this->getConsoleOutPutter();
        $this->output->setOutputer($output);

        $messages = $this->getSlackMessageRepo()->findBy([
            'actioned'      => false
        ]);

        $this->output->info(count($messages) .  " slack messages to send");

        foreach ($messages as $message) {
            $this->showTitle( "Sending message " . $message->getId());
            $this->output->info($message->getMessage());
            $this->getSlackService()->sendMessageToSlack($message);
            if (count($messages) > 1) {
                $this->output->infoid( "Waiting " . $this->slackSendDelaySeconds . " seconds");
                sleep($this->slackSendDelaySeconds);
            }
        }

    }

    private function showTitle($title)
    {
        $this->output->info(str_pad(" " . $title . " ", 80, "-", STR_PAD_BOTH));
    }

    private function getConsoleOutPutter() : ConsoleOutput
    {
        return $this->getContainer()->get('partfire_common.output_console');
    }

    private function getSlackMessageRepo() : SlackMessageRepository
    {
        return $this->getSlackeFactory()->getSlackMessage();
    }

    private function getSlackeFactory() : SlackRepositoryFactory
    {
        return $this->getContainer()->get('part_fire_slack.factory_repo');
    }

    private function getSlackService() : SlackService
    {
        return $this->getContainer()->get('part_fire_slack_service');
    }

}