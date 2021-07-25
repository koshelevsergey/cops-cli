<?php

namespace Cops\Cli\UseCase\Client\Order\Receipt;

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

    /**
     * Handler constructor.
     *
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param int $count
     *
     * @throws Exception
     */
    public function execute(int $count): void
    {
        $this->generator->generateLeads($count, function (Lead $lead) {

        });
    }
}
