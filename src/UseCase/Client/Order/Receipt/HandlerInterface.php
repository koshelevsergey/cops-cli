<?php

namespace Cops\Cli\UseCase\Client\Order\Receipt;

/**
 * Interface HandlerInterface
 *
 * @package Cops\Cli\UseCase\Client\Order\Receipt
 */
interface HandlerInterface
{
    /**
     * @param int $count
     *
     * @return void
     */
    public function execute(int $count): void;
}
