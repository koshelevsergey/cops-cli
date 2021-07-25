<?php

namespace Cops\Cli\UseCase\Client\Order\Report;

use Psr\Log\LoggerInterface;

/**
 * Class Handler
 *
 * @package Cops\Cli\UseCase\Client\Order\Report
 */
class Handler implements HandlerInterface
{
    /** @var LoggerInterface */
    private LoggerInterface $logger;

    /**
     * Handler constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param int $id
     * @param string $category
     *
     * @return void;
     */
    public function execute(int $id, string $category): void
    {
        // TODO :: Выполняется тяжелая операция (например формирование отчета).
        sleep(2);

        // TODO :: Если категория например pizza то отчет сформировать не удалось.
        if ($category === 'Pizza') {
            $this->logger->error("Report failed formed", [
                'lead_id' => $id,
                'lead_category' => $category
            ]);
        } else {
            $this->logger->info("Report successfully formed", [
                'lead_id' => $id,
                'lead_category' => $category
            ]);
        }
    }
}
