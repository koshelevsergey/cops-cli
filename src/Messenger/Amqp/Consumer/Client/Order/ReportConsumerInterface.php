<?php

namespace Cops\Cli\Messenger\Amqp\Consumer\Client\Order;

/**
 * Class ReportConsumerInterface
 *
 * @package Cops\Cli\Messenger\Amqp\Consumer\Client\Order
 */
interface ReportConsumerInterface
{
    /**
     * @return void
     */
    public function listener(): void;

    /**
     * @return void
     */
    public function close(): void;
}
