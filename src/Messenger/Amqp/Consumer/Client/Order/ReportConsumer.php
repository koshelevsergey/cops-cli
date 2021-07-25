<?php

namespace Cops\Cli\Messenger\Amqp\Consumer\Client\Order;

use Cops\Cli\Messenger\Amqp\TransportInterface;
use Cops\Cli\UseCase\Client\Order\Report\HandlerInterface;
use ErrorException;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

/**
 * Class ReportConsumer
 *
 * @package Cops\Cli\Messenger\Amqp\Consumer\Client\Order
 */
class ReportConsumer implements ReportConsumerInterface
{
    /** @var LoggerInterface */
    private LoggerInterface $logger;

    /** @var TransportInterface */
    private TransportInterface $transport;

    /** @var HandlerInterface */
    private HandlerInterface $handler;

    /**
     * ReceiptPublisher constructor.
     *
     * @param LoggerInterface $logger
     * @param TransportInterface $transport
     * @param HandlerInterface $handler
     */
    public function __construct(
        LoggerInterface $logger,
        TransportInterface $transport,
        HandlerInterface $handler
    )
    {
        $this->logger = $logger;
        $this->transport = $transport;
        $this->handler = $handler;
    }

    /**
     * @return void
     */
    public function listener(): void
    {
        try {
            $this->processMessage();
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
     * @throws ErrorException
     */
    protected function processMessage(): void
    {
        $this->transport->consumer(function (AMQPMessage $message) {
            $content = json_decode($message->getBody(), true, 512, JSON_THROW_ON_ERROR);

            $this->handler->execute($content['id'], $content['category']);

            $message->ack();
        });
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
