<?php

namespace Cops\Cli\Command\Client\Order;

use Cops\Cli\UseCase\Client\Order\Receipt\HandlerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ReceiptCommand
 *
 * @package Cops\Cli\Command\Client\Order
 */
class ReceiptCommand extends Command
{
    /** @var int */
    private const COUNT_ORDERS = 10000;

    /** @var string */
    protected static $defaultName = 'client:order:receipt, --count';

    /** @var HandlerInterface */
    private HandlerInterface $handler;

    /**
     * ProcessCommand constructor.
     *
     * @param HandlerInterface $handler
     */
    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Receiving and sending client orders to message bus. Default value 10000.');

        $this->addOption(
            'count',
            'c',
            InputArgument::OPTIONAL,
            'Number of processed orders',
            self::COUNT_ORDERS
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->handler->execute(
            $input->getOption('count')
        );

        $io->success("Client orders have been successfully received.");

        return self::SUCCESS;
    }
}
