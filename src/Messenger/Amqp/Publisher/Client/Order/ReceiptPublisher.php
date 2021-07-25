<?php

namespace Cops\Cli\Messenger\Amqp\Publisher\Client\Order;

use Cops\Cli\Messenger\Amqp\TransportInterface;
use Exception;
use JsonException;
use Psr\Log\LoggerInterface;

/**
 * Class ReceiptPublisher
 *
 * @package Cops\Cli\Messenger\Amqp\Publisher\Client\Order
 */
class ReceiptPublisher implements ReceiptPublisherInterface
{
    /** @var LoggerInterface */
    private LoggerInterface $logger;

    /** @var TransportInterface */
    private TransportInterface $transport;

    /**
     * ReceiptPublisher constructor.
     *
     * @param LoggerInterface $logger
     * @param TransportInterface $transport
     */
    public function __construct(LoggerInterface $logger, TransportInterface $transport)
    {
        $this->logger = $logger;
        $this->transport = $transport;
    }

    /**
     * @param int $id
     * @param string $category
     *
     * @return void
     */
    public function dispatch(int $id, string $category): void
    {
        try {
            $this->publish($id, $category);
        } catch (Exception $exception) {
            $this->logging($exception);
        }
    }

    /**
     * @return void
     */
    public function close(): void
    {
        try {
            $this->transport->close();
        } catch (Exception $exception) {
            $this->logging($exception);
        }
    }

    /**
     * @param int $id
     * @param string $category
     *
     * @return void
     * @throws JsonException
     */
    protected function publish(int $id, string $category): void
    {
        $message = json_encode([
            'id' => $id,
            'category' => $category
        ], JSON_THROW_ON_ERROR);

        $this->transport->publish($message);
    }

    /**
     * @param Exception $exception
     *
     * @return void
     */
    protected function logging(Exception $exception): void
    {
        $this->logger->error($exception->getMessage(), [
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ]);
    }
}
