<?php

namespace Cops\Cli\Command\Client\Order;

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
        return self::SUCCESS;
    }
}
