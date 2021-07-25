<?php

namespace Cops\Cli\Messenger\Amqp\Receiver;

/**
 * Class QueueDeclare
 *
 * @package Cops\Cli\Messenger\Amqp\Receiver
 */
class QueueDeclare
{
    /** @var string */
    private string $exchange,
        $routing,
        $query,
        $consumerTag;

    /** @var bool */
    private bool $passive,
        $durable,
        $exclusive,
        $autoDelete,
        $isNoLocal,
        $isNoAck,
        $isNoWait;

    /**
     * QueueDeclare constructor.
     *
     * @param string $exchange
     * @param string $routing
     * @param string $query
     * @param string $consumerTag
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param bool $autoDelete
     * @param bool $isNoLocal
     * @param bool $isNoAck
     * @param bool $isNoWait
     */
    public function __construct(
        string $exchange,
        string $routing,
        string $query,
        string $consumerTag,
        bool $passive,
        bool $durable,
        bool $exclusive,
        bool $autoDelete,
        bool $isNoLocal,
        bool $isNoAck,
        bool $isNoWait
    )
    {
        $this->exchange = $exchange;
        $this->routing = $routing;
        $this->query = $query;
        $this->consumerTag = $consumerTag;
        $this->passive = $passive;
        $this->durable = $durable;
        $this->exclusive = $exclusive;
        $this->autoDelete = $autoDelete;
        $this->isNoLocal = $isNoLocal;
        $this->isNoAck = $isNoAck;
        $this->isNoWait = $isNoWait;
    }

    /**
     * @return string
     */
    public function getExchange(): string
    {
        return $this->exchange;
    }

    /**
     * @return string
     */
    public function getRouting(): string
    {
        return $this->routing;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getConsumerTag(): string
    {
        return $this->consumerTag;
    }

    /**
     * @return bool
     */
    public function isPassive(): bool
    {
        return $this->passive;
    }

    /**
     * @return bool
     */
    public function isDurable(): bool
    {
        return $this->durable;
    }

    /**
     * @return bool
     */
    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    /**
     * @return bool
     */
    public function isAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    /**
     * @return bool
     */
    public function isNoLocal(): bool
    {
        return $this->isNoLocal;
    }

    /**
     * @return bool
     */
    public function isNoAck(): bool
    {
        return $this->isNoAck;
    }

    /**
     * @return bool
     */
    public function isNoWait(): bool
    {
        return $this->isNoWait;
    }
}
