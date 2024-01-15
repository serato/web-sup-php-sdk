<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\UserGroup;

class UserGroupTest extends PHPUnitTestCase
{
    public function testSettersWithCorrectValues(): void
    {
        $userId = 123;
        $groups = [
            [
                UserGroup::ID => 5,
                UserGroup::NAME => "Group Five"
            ],
            [
                UserGroup::ID => 40,
                UserGroup::NAME => "Group Forty"
            ]
        ];

        $userGroup = UserGroup::create($userId)->setGroups($groups);

        $this->assertEquals('UserGroup', $userGroup->getType());
        $this->assertEquals($groups, $userGroup->getGroups());
    }

    public function testSettersWithEmptyArray(): void
    {
        $userId = 123;
        $groups = [];

        $userGroup = UserGroup::create($userId)->setGroups($groups);

        $this->assertEquals('UserGroup', $userGroup->getType());
        $this->assertEquals($groups, $userGroup->getGroups());
    }

    /**
     * @expectedException Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException
     */
    public function testSettersWithIncorrectValues(): void
    {
        $userId = 123;
        $groups = [
            [
                // String is passed for ID instead of integer
                UserGroup::ID => "five",
                UserGroup::NAME => "Group Five"
            ]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    /**
     * @expectedException Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException
     */
    public function testSettersWithIncorrectValues2(): void
    {
        $userId = 123;
        $groups = [
            [
                UserGroup::ID => 5,
                // Integer is passed for NAME instead of string
                UserGroup::NAME => 5
            ]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    /**
     * @expectedException Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException
     */
    public function testSettersWithIncorrectValues3(): void
    {
        $userId = 123;
        $groups = [
            ["id" => "invalidData"]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    /**
     * @expectedException Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException
     */
    public function testSettersWithIncorrectStructure(): void
    {
        $userId = 123;
        // Invalid array structure
        $groups = [
            [
                UserGroup::ID => 5
            ]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    /**
     * @expectedException Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException
     */
    public function testSettersWithIncorrectStructure2(): void
    {
        $userId = 123;
        // Invalid array structure
        $groups = [
            [
                UserGroup::ID => 5,
                UserGroup::NAME => "Group Five",
                // Invalid key in array
                "InvalidKey" => "someValue"
            ]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }
}
