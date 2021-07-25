<?php

namespace Cops\Cli\Messenger\Amqp;

use Cops\Cli\Messenger\Amqp\Receiver\QueueDeclare;
use ErrorException;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class Transport
 *
 * @package Cops\Cli\Messenger\Amqp
 */
class Transport implements TransportInterface
{
    /** @var AMQPStreamConnection */
    private AMQPStreamConnection $connection;

    /** @var AMQPChannel */
    private AMQPChannel $channel;

    /** @var AMQPMessage */
    private AMQPMessage $message;

    /** @var QueueDeclare */
    private QueueDeclare $queueDeclare;

    /**
     * Connection constructor.
     *
     * @param AMQPStreamConnection $connection
     * @param AMQPMessage $message
     * @param QueueDeclare $queueDeclare
     */
    public function __construct(
        AMQPStreamConnection $connection,
        AMQPMessage $message,
        QueueDeclare $queueDeclare
    )
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->message = $message;
        $this->queueDeclare = $queueDeclare;

        $this->registerQueueDeclare();
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function publish(string $message): void
    {
        $this->channel->basic_publish(
            $this->message->setBody($message),
            $this->queueDeclare->getExchange(),
            $this->queueDeclare->getRouting()
        );
    }

    /**
     * @param callable $callback
     *
     * @throws ErrorException
     */
    public function consumer(callable $callback): void
    {
        $this->channel->basic_consume(
            $this->queueDeclare->getQuery(),
            $this->queueDeclare->getConsumerTag(),
            $this->queueDeclare->isNoLocal(),
            $this->queueDeclare->isNoAck(),
            $this->queueDeclare->isExclusive(),
            $this->queueDeclare->isNoWait(),
            $callback
        );

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    /**
     * @throws Exception
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * @return void
     */
    private function registerQueueDeclare(): void
    {
        $this->channel->queue_declare(
            $this->queueDeclare->getQuery(),
            $this->queueDeclare->isPassive(),
            $this->queueDeclare->isDurable(),
            $this->queueDeclare->isExclusive(),
            $this->queueDeclare->isAutoDelete()
        );
    }
}
