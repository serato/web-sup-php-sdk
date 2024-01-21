<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\AbstractMessage;

class AbstractMessageTest extends PHPUnitTestCase
{
    /** @var AbstractMessage */
    private $mockMessage;

    public function testGetMethods(): void
    {
        $userId = 111;
        $params = ['param1' => 'val1', 'param2' => 22];

        $this->createAbstractMessageMock($userId, $params);

        $this->assertEquals($userId, $this->mockMessage->getUserId());
        $this->assertEquals($params, $this->mockMessage->getParams());
    }

    /**
     * @param int $userId
     * @param array<string, mixed> $params
     */
    private function createAbstractMessageMock($userId, $params): void
    {
        $this->mockMessage = $this->getMockForAbstractClass(
            AbstractMessage::class,
            [$userId, $params]
        );
    }
}
