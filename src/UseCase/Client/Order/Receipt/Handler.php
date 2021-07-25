<?php

namespace Cops\Cli\UseCase\Client\Order\Receipt;

use Cops\Cli\Messenger\Amqp\Publisher\Client\Order\ReceiptPublisherInterface;
use Exception;
use LeadGenerator\Generator;
use LeadGenerator\Lead;

/**
 * Class Handler
 *
 * @package Cops\Cli\UseCase\Client\Order\Receipt
 */
class Handler implements HandlerInterface
{
    /** @var Generator */
    private Generator $generator;

    /** @var ReceiptPublisherInterface */
    private ReceiptPublisherInterface $receiptPublisher;

    /**
     * Handler constructor.
     *
     * @param Generator $generator
     * @param ReceiptPublisherInterface $receiptPublisher
     */
    public function __construct(Generator $generator, ReceiptPublisherInterface $receiptPublisher)
    {
        $this->generator = $generator;
        $this->receiptPublisher = $receiptPublisher;
    }

    /**
     * @param int $count
     *
     * @throws Exception
     */
    public function execute(int $count): void
    {
        $this->generator->generateLeads($count, function (Lead $lead) {
            $this->receiptPublisher->dispatch($lead->id, $lead->categoryName);
        });

        $this->receiptPublisher->close();
    }
}
