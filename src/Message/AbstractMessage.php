<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Queue\AbstractMessageQueue;

/**
 * Base class from which all concrete message implementations much inherit.
 *
 * Each concrete implementation represents a user action or event that is
 * captured with specific attributes and placed into a queue for downstream
 * processing by the Serato User Profile application.
 *
 * Child classes need only implement `get` and `set` methods to populate the
 * `AbstractMessage::params` property.
 */
abstract class AbstractMessage
{
    /** @var array<array> */
    private $params = [];

    /** @var int */
    private $userId;

    /**
     * Constructs the instance
     *
     * @param int   $userId         User ID
     * @param array<array> $params         Array of message parameters
     */
    public function __construct(int $userId, array $params = [])
    {
        $this->userId = $userId;
        $this->params = $params;
    }

    /**
     * Create a message object
     *
     * @param int $userId
     * @param array<array> $params
     * @return mixed
     */
    abstract public static function create(int $userId, array $params = []);

    /**
     * Send the message to message queue
     *
     * @param AbstractMessageQueue  $queue  A concrete abstract queue instance
     * @return mixed  A unique message identifier
     */
    public function send(AbstractMessageQueue $queue)
    {
        return $queue->sendMessage($this);
    }

    /**
     * Send the message for delivery as part of batch send operation
     *
     * @param AbstractMessageQueue  $queue  A concrete abstract queue instance
     * @return void
     */
    public function sendToBatch(AbstractMessageQueue $queue): void
    {
        $queue->sendMessageToBatch($this);
    }

    /**
     * Returns the message params
     *
     * @return array<array>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Returns the user ID
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Returns the type of message
     *
     * @return string
     */
    public function getType(): string
    {
        $className = get_class($this);
        return substr($className, strrpos($className, '\\') + 1);
    }

    /**
     * Set a parameter value
     *
     * @param string    $name   Parameter name
     * @param mixed     $value  Parameter value
     * @return void
     */
    protected function setParam($name, $value): void
    {
        $this->params[$name] = $value;
    }

    /**
     * Get a parameter value
     *
     * @param string    $name   Parameter name
     * @return null | mixed
     */
    protected function getParam($name)
    {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }
}
