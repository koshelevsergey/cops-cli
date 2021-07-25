<?php

namespace Cops\Cli\Command\Client\Order;

use Cops\Cli\Messenger\Amqp\Consumer\Client\Order\ReportConsumerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessCommand
 *
 * @package Cops\Cli\Command\Client\Order
 */
class ReportCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'client:order:report';

    /** @var ReportConsumerInterface */
    private ReportConsumerInterface $reportConsumer;

    /**
     * ProcessCommand constructor.
     *
     * @param ReportConsumerInterface $reportConsumer
     */
    public function __construct(ReportConsumerInterface $reportConsumer)
    {
        $this->reportConsumer = $reportConsumer;

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Generating a report with receiving data from the message bus.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->reportConsumer->listener();
        $this->reportConsumer->close();

        return self::SUCCESS;
    }
}
