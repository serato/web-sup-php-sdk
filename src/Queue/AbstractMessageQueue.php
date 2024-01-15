<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Queue;

use Serato\UserProfileSdk\Message\AbstractMessage;
use Serato\UserProfileSdk\Exception\InvalidMessageTypeException;
use Serato\UserProfileSdk\Exception\QueueSendException;

/**
 * Base class for interacting with a message queue.
 *
 * All concrete queue implementations should inherit from this class.
 *
 * **Abstract methods:**
 *
 * - `sendMessage` : sends an `Serato\UserProfileSdk\Message\AbstractMessage` instance to the queue.
 * - `createMessage` : converts a raw queue message back into it's source
 * `Serato\UserProfileSdk\Message\AbstractMessage` instance.
 */
abstract class AbstractMessageQueue
{
    private const MESSAGE_TYPE = 'type';
    private const MESSAGE_BODY = 'message';

    /**
     * Send a message to the queue
     *
     * @param AbstractMessage   $message    Message instance
     * @return mixed     A unique message identifier
     *
     * @throws QueueSendException
     */
    abstract public function sendMessage(AbstractMessage $message);

    /**
     * Send a message for delivery as part of batch send operation
     *
     * @param AbstractMessage   $message    Message instance
     * @return void
     *
     * @throws QueueSendException
     */
    abstract public function sendMessageToBatch(AbstractMessage $message): void;

    /**
     * Wrap a `AbstractMessage` instance's body with the name of the child
     * message class into an array suitable for sending to the queue.
     *
     * @param AbstractMessage   $message    Message instance
     * @return array<array>
     */
    protected function getWrappedMessageBody(AbstractMessage $message): array
    {
        return [
            self::MESSAGE_TYPE   => $message->getType(),
            self::MESSAGE_BODY   => $message->getParams()
        ];
    }

    /**
     * Return an `AbstractMessage` message from a user ID and an array of data that
     * represents a single message body read from the queue.
     *
     * @param int       $userId         User ID
     * @param array<array>     $messageBody    Array of message body data
     * @param array<array>     $classMap       A map of message types to class names (optional)
     *
     * @return mixed    An AbstractMessage instance
     *
     * @throws InvalidMessageTypeException
     */
    protected static function getMessageFromWrappedBody($userId, array $messageBody, array $classMap = [])
    {
        if (count($classMap) === 0) {
            $classMap = self::getDefaultClassMap();
        }

        $messageType = $messageBody[self::MESSAGE_TYPE];

        if (!isset($classMap[$messageType])) {
            throw new InvalidMessageTypeException();
        } else {
            $messageClass = $classMap[$messageType];
            return $messageClass::create($userId, $messageBody[self::MESSAGE_BODY]);
        }
    }

    /**
     * Returns a class map of all message classes defined in the `Message` directory.
     *
     * ie. All non-abstract classes defined under the `Serato\UserProfileSdk\Message`
     * namespace.
     *
     * @return array<array>
     */
    private static function getDefaultClassMap(): array
    {
        $map = [];
        $ns = '\\Serato\\UserProfileSdk\\Message\\';
        $paths = glob(realpath(__DIR__ . '/../Message') . '/*.php');
        if (is_iterable($paths)) {
            foreach ($paths as $path) {
                $type = str_replace('.php', '', substr($path, strrpos($path, '/') + 1));
                if ($type !== 'AbstractMessage') {
                    $map[$type] = $ns . $type;
                }
            }
        }
        return $map;
    }
}
