<?php

namespace Cops\Cli\UseCase\Client\Order\Report;

/**
 * Interface HandlerInterface
 *
 * @package Cops\Cli\UseCase\Client\Order\Report
 */
interface HandlerInterface
{
    /**
     * @param int $id
     * @param string $category
     *
     * @return void
     */
    public function execute(int $id, string $category): void;
}
