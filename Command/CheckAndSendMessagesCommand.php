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
use PartFire\SlackBundle\Entity\SlackMessage;
use PartFire\SlackBundle\Services\SlackService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PartFire\CommonBundle\Services\Output\Cli\ConsoleOutput;

class CheckAndSendMessagesCommand extends Command
{
    private $slackSendDelaySeconds = 1;
    /**
     * @var ConsoleOutput
     */
    private $output;
    /**
     * @var SlackRepositoryFactory
     */
    private $slackRepositoryFactory;
    /**
     * @var SlackService
     */
    private $slackService;

    public function __construct(
        ConsoleOutput $consoleOutput,
        SlackRepositoryFactory $slackRepositoryFactory,
        SlackService $slackService,
        ?string $name = null
    ){
        parent::__construct($name);
        $this->output = $consoleOutput;
        $this->slackRepositoryFactory = $slackRepositoryFactory;
        $this->slackService = $slackService;
    }

    protected function configure()
    {
        $this
            ->setName('partfire:slack:check-and-send')
            ->setDescription('Checks for any slack messages, and sends them')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output->setOutputer($output);

        $messages = $this->getSlackMessageRepository()->findBy([
            'actioned'      => false
        ]);

        $this->output->info(count($messages) .  " slack messages to send");

        foreach ($messages as $message) {
            if ($message instanceof SlackMessage) {
                $this->showTitle("Sending message " . $message->getId());
                $this->output->info($message->getMessage());
                $this->slackService->sendMessageToSlack($message);
                if (count($messages) > 1) {
                    $this->output->infoid("Waiting " . $this->slackSendDelaySeconds . " seconds");
                    sleep($this->slackSendDelaySeconds);
                }
            }
        }
    }

    private function showTitle($title)
    {
        $this->output->info(str_pad(" " . $title . " ", 80, "-", STR_PAD_BOTH));
    }

    private function getSlackMessageRepository() : SlackMessageRepository
    {
        return $this->slackRepositoryFactory->getSlackMessage();
    }
}
