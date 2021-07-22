<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\AuthorizeApplication;

class AuthorizeApplicationTest extends PHPUnitTestCase
{
    /**
     * Tests that in the default constructed state, the message does not throw exceptions when invoking accessors
     * to its properties.
     */
    public function testDefaultValues(): void
    {
        $userId = 123;
        $message = AuthorizeApplication::create($userId);
        $this->assertEquals($userId, $message->getUserId());
        $this->assertEquals([], $message->getParams());
        $this->assertEquals(null, $message->getAppName());
        $this->assertEquals(null, $message->getAuthorizationTime());
    }

    /**
     * Tests that all setters for the message are working correctly
     */
    public function testSetters(): void
    {
        $userId = 123;
        $appName = 'serato_studio';
        $authorizationTime = '2017-08-15T15:52:01+00:00';
        $message = AuthorizeApplication::create($userId)
            ->setAppName($appName)
            ->setAuthorizationTime($authorizationTime);

        $expectedParams = [
            AuthorizeApplication::APP_NAME => $appName,
            AuthorizeApplication::AUTHORIZATION_TIME => $authorizationTime
        ];

        $this->assertEquals($userId, $message->getUserId());
        $this->assertEquals($expectedParams, $message->getParams());
        $this->assertEquals($appName, $message->getAppName());
        $this->assertEquals($authorizationTime, $message->getAuthorizationTime());

        $timestamp = 1583730684;
        $expectedTime = "2020-03-09T05:11:24+00:00"; # Equivalent to the above
        $expectedParams = [
            AuthorizeApplication::APP_NAME => $appName,
            AuthorizeApplication::AUTHORIZATION_TIME => $expectedTime
        ];
        $message->setAuthorizationTimestamp($timestamp);
        $this->assertEquals($expectedTime, $message->getAuthorizationTime());
        $this->assertEquals($expectedParams, $message->getParams());
    }

    /**
     * Tests that passing in arguments via an array rather than function calls works correctly
     */
    public function testSetByParams(): void
    {
        $userId = 123;
        $appName = 'serato_studio';
        $authorizationTime = '2017-08-15T15:52:01+00:00';
        $params = [
            AuthorizeApplication::APP_NAME => $appName,
            AuthorizeApplication::AUTHORIZATION_TIME => $authorizationTime
        ];
        $message = AuthorizeApplication::create($userId, $params);

        $this->assertEquals($userId, $message->getUserId());
        $this->assertEquals($params, $message->getParams());
        $this->assertEquals($appName, $message->getAppName());
        $this->assertEquals($authorizationTime, $message->getAuthorizationTime());
    }
}
