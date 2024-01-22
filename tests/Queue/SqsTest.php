<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Queue;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Aws\Sdk;
use Aws\Result;
use Aws\MockHandler;
use Aws\Credentials\CredentialProvider;
use Aws\Sqs\Exception\SqsException;
use Serato\UserProfileSdk\Queue\Sqs;
use Serato\UserProfileSdk\Message\AbstractMessage;
use Serato\UserProfileSdk\Test\Queue\TestMessage;
use Ramsey\Uuid\Uuid;

class SqsTest extends PHPUnitTestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var AbstractMessage */
    private $mockMessage;

    public function testSendMessage(): void
    {
        $this->createAbstractMessageMock(111);

        $results = [
            new Result(['QueueUrl'  => 'my-queue-url']),
            new Result(['MessageId' => 'TestMessageId1']),
            new Result(['MessageId' => 'TestMessageId2'])
        ];
        $queue = new Sqs(
            $this->getMockedAwsSdk($results)->createSqs(['version' => '2012-11-05']),
            'my-queue-name'
        );

        # Test one of the syntax forms
        $this->assertEquals('TestMessageId1', $queue->sendMessage($this->mockMessage));
        # And the other form
        $this->assertEquals('TestMessageId2', $this->mockMessage->send($queue));
        // Mock handler stack should be empty
        $this->assertEquals(0, $this->getAwsMockHandlerStackCount());
    }

    /**
     * @group xxx
     */
    public function testSendBatches(): void
    {
        // Send 25 messages and ensure that the SDK sends the batches correctly

        $results = [
            new Result(['QueueUrl'  => 'my-queue-url']),
            // Results from sending first batch
            new Result([]),
            // Results from sending second batch
            new Result([]),
            // Results from sending third batch
            new Result([])
        ];

        $queue = new Sqs(
            $this->getMockedAwsSdk($results)->createSqs(['version' => '2012-11-05']),
            'my-queue-name'
        );

        $this->createAbstractMessageMock(111);

        for ($i = 0; $i < 25; $i++) {
            $queue->sendMessageToBatch($this->mockMessage);
        }

        // Destroy $queue object to send remaining messages
        unset($queue);

        // Mock handler stack should be empty
        $this->assertEquals(0, $this->getAwsMockHandlerStackCount());
    }

    /**
     * @expectedException \Serato\UserProfileSdk\Exception\QueueSendException
     */
    public function testSendMessageQueueSendException(): void
    {
        $this->createAbstractMessageMock(111);

        // Create an S3 client so that we can (easily) create an AWS Command object
        $sqsClient = $this->getMockedAwsSdk()->createSqs(['version' => '2012-11-05']);
        $cmd = $sqsClient->getCommand('SendMessage', [
            'MessageBody'   => 'a message body',
            'QueueUrl'      => 'my-queue-url'
        ]);

        $results = [
            new Result(['QueueUrl'  => 'my-queue-url']),
            new SqsException('No Attribute MD5 found', $cmd, ['code' => 'ClientChecksumMismatch'])
        ];

        $queue = new Sqs(
            $this->getMockedAwsSdk($results)->createSqs(['version' => '2012-11-05']),
            'my-queue-name'
        );

        $this->assertEquals('TestMessageId1', $queue->sendMessage($this->mockMessage));
    }

    /**
     * @expectedException \Serato\UserProfileSdk\Exception\QueueSendException
     */
    public function testSendMessageToBatchQueueSendException(): void
    {
        $this->createAbstractMessageMock(111);

        // Create an S3 client so that we can (easily) create an AWS Command object
        $sqsClient = $this->getMockedAwsSdk()->createSqs(['version' => '2012-11-05']);
        $cmd = $sqsClient->getCommand('SendMessage', [
            'MessageBody'   => 'a message body',
            'QueueUrl'      => 'my-queue-url'
        ]);

        $results = [
            new Result(['QueueUrl'  => 'my-queue-url']),
            new SqsException('No Attribute MD5 found', $cmd, ['code' => 'ClientChecksumMismatch'])
        ];

        $queue = new Sqs(
            $this->getMockedAwsSdk($results)->createSqs(['version' => '2012-11-05']),
            'my-queue-name'
        );

        $queue->sendMessageToBatch($this->mockMessage);
    }

    /**
     * @expectedException \Serato\UserProfileSdk\Exception\InvalidMessageBodyException
     */
    public function testCreateMessageWithInvalidMd5(): void
    {
        Sqs::createMessage([
            'Body'      => 'A message body',
            'MD5OfBody' => md5('A different message body')
        ]);
    }

    public function testCreateMessage(): void
    {
        $results = [
            new Result(['QueueUrl'  => 'my-queue-url'])
        ];

        $queue = new Sqs(
            $this->getMockedAwsSdk($results)->createSqs(['version' => '2012-11-05']),
            'my-queue-url'
        );

        # We need to construct a valid `Result` array to pass into the
        # Sqs::createMessage method.
        # Easiest way to do this is to create a mock message and use
        # the Sqs::messageToSqsSendParams method.

        $userId = 666;
        $params = ['param1' => 'val1', 'param2' => 22];

        $mockMessage = TestMessage::create(666, $params);

        $sqsSendParams = $queue->messageToSqsSendParams($mockMessage);

        $sqsReceiveResult = [
            'Body'              => $sqsSendParams['MessageBody'],
            'MD5OfBody'         => md5($sqsSendParams['MessageBody']),
            'MessageAttributes' => $sqsSendParams['MessageAttributes']
        ];

        $receivedMockMessage = Sqs::createMessage(
            $sqsReceiveResult,
            [$mockMessage->getType() => get_class($mockMessage)]
        );

        $this->assertEquals($receivedMockMessage->getUserId(), $userId);
        $this->assertEquals($receivedMockMessage->getParams(), $params);
        // Mock handler stack should be empty
        $this->assertEquals(0, $this->getAwsMockHandlerStackCount());
    }

    /**
     * @group aws-integration
     */
    public function testAwsIntegrationTest(): void
    {
        $userId = 555;
        $scalarMessageValue = 'A scalar value';
        $arrayMessageValue = ['param1' => 'val1', 'param2' => 22];

        $queueName = 'SeratoUserProfile-Events-test-' . Uuid::uuid4()->toString();

        # Credentials come from:
        # - credentials file on dev VMs
        # - .env variables on build VMs

        $sdk = new Sdk([
            'region' => 'us-east-1',
            'version' => '2014-11-01',
            'credentials' => CredentialProvider::memoize(
                CredentialProvider::chain(
                    CredentialProvider::ini(),
                    CredentialProvider::env()
                )
            )
        ]);
        $awsSqs = $sdk->createSqs(['version' => '2012-11-05']);

        $supQueue = new Sqs($awsSqs, $queueName);

        # Send message via `Serato\UserProfileSdk\Queue\Sqs` instance
        $testMessage = TestMessage::create($userId)
                        ->setScalarValue($scalarMessageValue)
                        ->setArrayValue($arrayMessageValue);
        $messageId = $testMessage->send($supQueue);

        # Use the `Aws\Sdk` instance to receive the message
        # (receiving messages is not the responsibility of the `Serato\UserProfileSdk` SDK)
        $result = [];
        $polls = 0;
        # Might need to poll the queue a few times before getting the message
        # But limit to 5 attempts
        while ($polls < 5 && (!isset($result['Messages']) || count($result['Messages']) === 0)) {
            $result = $awsSqs->receiveMessage([
                'WaitTimeSeconds'       => 20,
                'MessageAttributeNames' => ['All'],
                'QueueUrl'              => $supQueue->getQueueUrl()
            ]);
            $polls++;
        }

        $this->assertTrue(isset($result['Messages']) && count($result['Messages']) > 0);

        /** @phpstan-ignore-next-line */
        if (isset($result['Messages']) && is_array($result['Messages']) && count($result['Messages']) > 0) {
            $message = $result['Messages'][0];
            $this->assertEquals($message['MessageId'], $messageId);

            $testMessageReceived = Sqs::createMessage(
                $message,
                [$testMessage->getType() => get_class($testMessage)]
            );

            $this->assertEquals($testMessageReceived->getScalarValue(), $scalarMessageValue);
            $this->assertEquals($testMessageReceived->getArrayValue(), $arrayMessageValue);
        }

        # Delete the queue using the AWS SDK
        $awsSqs->deleteQueue(['QueueUrl' => $supQueue->getQueueUrl()]);
    }

    /**
     * @param array<int, mixed> $mockResults  An array of mock results to return from SDK clients
     * @return Sdk
     */
    protected function getMockedAwsSdk(array $mockResults = [])
    {
        $this->mockHandler = new MockHandler();
        foreach ($mockResults as $result) {
            $this->mockHandler->append($result);
        }
        return new Sdk([
            'region' => 'us-east-1',
            'version' => '2014-11-01',
            'credentials' => [
                'key' => 'my-access-key-id',
                'secret' => 'my-secret-access-key'
            ],
            'handler' => $this->mockHandler
        ]);
    }

    /**
     * Returns the number of remaining items in the AWS mock handler queue.
     *
     * @return int
     */
    protected function getAwsMockHandlerStackCount()
    {
        return $this->mockHandler->count();
    }

    /**
     * @param int $userId
     * @param array<array> $params
     */
    private function createAbstractMessageMock($userId, $params = []): void
    {
        $this->mockMessage = $this->getMockForAbstractClass(
            AbstractMessage::class,
            [$userId, $params]
        );
    }
}
