<?php

namespace Cops\Cli\Messenger\Amqp;

use ErrorException;
use Exception;

/**
 * Interface TransportInterface
 *
 * @package Cops\Cli\Messenger\Amqp
 */
interface TransportInterface
{
    /**
     * @param string $message
     *
     * @return void
     */
    public function publish(string $message): void;

    /**
     * @param callable $callback
     *
     * @throws ErrorException
     */
    public function consumer(callable $callback): void;

    /**
     * @throws Exception
     */
    public function close(): void;
}
