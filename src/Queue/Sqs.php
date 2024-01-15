<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Queue;

use Aws\Result;
use Aws\Sqs\SqsClient;
use Serato\UserProfileSdk\Message\AbstractMessage;
use Serato\UserProfileSdk\Exception\InvalidMessageBodyException;
use Serato\UserProfileSdk\Exception\QueueSendException;
use Aws\Exception\AwsException;
use Aws\Sqs\Exception\SqsException;
use Ramsey\Uuid\Uuid;

/**
 * AWS SQS queue implementation.
 *
 * Send `Serato\UserProfileSdk\Message\AbstractMessage` instances via an SQS
 * message queue.
 */
class Sqs extends AbstractMessageQueue
{
    private const MAX_BATCH_SIZE = 10;

    /** @var SqsClient */
    private $sqsClient;

    /** @var string */
    private $sqsQueueName;

    /** @var string */
    private $sqsQueueUrl;

    /** @var array */
    private $messageBatch = [];

    /** @var boolean */
    private $fifoQueue = true;

    /**
     * Constructs the instance
     *
     * @param SqsClient     $sqsClient      An AWS SDK SQS client instance
     * @param string        $sqsQueueName   Name of SQS queue
     * @param string        $sqsQueueUrl    URL of SQS queue
     */
    public function __construct(SqsClient $sqsClient, $sqsQueueName, $sqsQueueUrl = null)
    {
        $this->sqsClient = $sqsClient;
        $this->sqsQueueName = $sqsQueueName;
        if ($sqsQueueUrl !== null) {
            $this->sqsQueueUrl = $sqsQueueUrl;
        }
    }

    public function __destruct()
    {
        $this->sendMessageBatch();
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(AbstractMessage $message)
    {
        try {
            $result = $this
                        ->sqsClient
                        ->sendMessage($this->messageToSqsSendParams($message));
            return $result['MessageId'];
        } catch (AwsException $e) {
            $this->throwQueueSendException($e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessageToBatch(AbstractMessage $message): void
    {
        if (count($this->messageBatch) === self::MAX_BATCH_SIZE) {
            $this->sendMessageBatch();
        }
        $this->messageBatch[] = $this->messageToSqsSendParams($message, (string)count($this->messageBatch));
    }

    /**
     * Return an `AbstractMessage` instance from a raw queue message
     *
     * @param mixed          $sqsMessage   A raw queue message
     * @param array<array>   $classMap     A map of message types to class names (optional)
     *
     * @return mixed    An AbstractMessage instance
     *
     * @throws InvalidMessageBodyException
     */
    public static function createMessage($sqsMessage, array $classMap = [])
    {
        if (md5($sqsMessage['Body']) !== $sqsMessage['MD5OfBody']) {
            throw new InvalidMessageBodyException(
                'Message `Body` md5 hash does not match message ' .
                '`MD5OfBody` value.'
            );
        }

        $body = json_decode($sqsMessage['Body'], true);

        if ($body === null) {
            throw new InvalidMessageBodyException(
                'Message `Body` does not contain a valid JSON encoded string.'
            );
        }

        return self::getMessageFromWrappedBody(
            (int)$sqsMessage['MessageAttributes']['UserId']['StringValue'],
            $body,
            $classMap
        );
    }

    /**
     * Convert an AbstractMessage into a param array suitable for sending
     * to an SQS queue
     *
     * @param AbstractMessage   $message            Message instance
     * @param string            $batchMessageId     An ID that is unique within a batch of
     *                                              messages (required for batch operations)
     * @return array<array>
     */
    public function messageToSqsSendParams(AbstractMessage $message, string $batchMessageId = null)
    {
        return array_merge(
            [
                'MessageAttributes' => [
                    'UserId' => [
                        'DataType'      => 'Number',
                        'StringValue'   => (string)$message->getUserId()
                    ]
                ],
                'MessageBody'               => json_encode($this->getWrappedMessageBody($message)),
                'MessageDeduplicationId'    => Uuid::uuid4()->toString()
            ],
            ($this->fifoQueue ? ['MessageGroupId' => (string)$message->getUserId()] : []),
            // If message is NOT part of batch add the queue URL
            // If it IS part of batch add the message ID
            ($batchMessageId === null ?
                ['QueueUrl' => $this->getQueueUrl()] :
                ['Id' => $batchMessageId]
            )
        );
    }

    /**
     * Get the SQS queue URL
     *
     * @return string
     */
    public function getQueueUrl()
    {
        if ($this->sqsQueueUrl === null) {
            try {
                $result = $this->sqsClient->getQueueUrl(['QueueName' => $this->getRealQueueName()]);
                $this->sqsQueueUrl = $result['QueueUrl'];
            } catch (SqsException $e) {
                if ($e->getAwsErrorCode() === 'AWS.SimpleQueueService.NonExistentQueue') {
                    $attributes = [
                        'VisibilityTimeout'             => 10,
                        # Create queue with long polling enabled
                        'ReceiveMessageWaitTimeSeconds' => 20
                    ];
                    if ($this->fifoQueue) {
                        $attributes['FifoQueue'] = 'true';
                    }
                    $result = $this->sqsClient->createQueue([
                        'QueueName' => $this->getRealQueueName(),
                        'Attributes' => $attributes
                    ]);
                    $this->sqsQueueUrl = $result['QueueUrl'];
                } else {
                    throw $e;
                }
            }
        }
        return $this->sqsQueueUrl;
    }

    /**
     * @return Result|null
     */
    private function sendMessageBatch(): ?Result
    {
        if (count($this->messageBatch) > 0) {
            try {
                $result = $this
                            ->sqsClient
                            ->sendMessageBatch([
                                'Entries'   => $this->messageBatch,
                                'QueueUrl'  => $this->getQueueUrl()
                            ]);
                $this->messageBatch = [];
                return $result;
            } catch (AwsException $e) {
                $this->throwQueueSendException($e);
            }
        }
    }

    /**
     * @return string
     */
    private function getRealQueueName()
    {
        return $this->sqsQueueName . ($this->fifoQueue ? '.fifo' : '');
    }

    /**
     * Throws a `QueueSendException` exception in response to catching an
     * `AwsException` exception.
     *
     * Uses the`AwsException` instance to create a meaningful error message when
     * throwing the `QueueSendException` exception.
     *
     * @throws QueueSendException
     */
    private function throwQueueSendException(AwsException $e): void
    {
        $msg = 'Error sending message to SQS queue `' . $this->getRealQueueName() .
                '`.' . PHP_EOL .
                'The AWS SDK threw an exception with the following details:' . PHP_EOL .
                'Exception class: ' . get_class($e) . PHP_EOL .
                'Exception message: ' . $e->getMessage();

        if ($e->getAwsErrorMessage() !== null) {
            $msg .= PHP_EOL . 'AWS error message: ' . $e->getAwsErrorMessage();
        }
        if ($e->getAwsErrorType() !== null) {
            $msg .= PHP_EOL . 'AWS error type: ' . $e->getAwsErrorType();
        }
        if ($e->getAwsErrorCode() !== null) {
            $msg .= PHP_EOL . 'AWS error code: ' . $e->getAwsErrorCode();
        }

        throw new QueueSendException($msg);
    }
}
