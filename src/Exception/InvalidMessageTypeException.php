<?php

namespace Serato\UserProfileSdk\Exception;

use RuntimeException;

/**
 * Represents an error in the type of message received from a queue.
 *
 * Suggests the the `Serato\UserProfileSdk\Message\AbstractMessage::getType` method
 * of the message class is returning an invalid value, or the the message type is
 * not defined in the class map used by `Serato\UserProfileSdk\Queue\AbstractMessageQueue`
 */
class InvalidMessageTypeException extends RuntimeException
{
    /**
     * @var string
     */
    protected $message = "Invalid message type.\n\nCheck that the message type " .
                                "is defined in the class map used by " .
                                "`Serato\UserProfileSdk\Queue\AbstractMessageQueue`.";
}
