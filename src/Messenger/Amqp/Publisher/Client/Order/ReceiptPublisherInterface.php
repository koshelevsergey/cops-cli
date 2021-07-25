<?php

namespace Cops\Cli\Messenger\Amqp\Publisher\Client\Order;

/**
 * Interface ReceiptPublisherInterface
 *
 * @package Cops\Cli\Messenger\Amqp\Publisher\Client\Order
 */
interface ReceiptPublisherInterface
{
    /**
     * @param int $id
     * @param string $category
     *
     * @return void
     */
    public function dispatch(int $id, string $category): void;

    /**
     * @return void
     */
    public function close(): void;
}
