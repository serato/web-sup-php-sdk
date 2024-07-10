<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\UserGroup;
use Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException;
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

    public function testSettersWithIncorrectValues(): void
    {
        $this->expectException(InvalidUserGroupMessageException::class);
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

    public function testSettersWithIncorrectValues2(): void
    {
        $this->expectException(InvalidUserGroupMessageException::class);
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

    public function testSettersWithIncorrectValues3(): void
    {
        $this->expectException(InvalidUserGroupMessageException::class);
        $userId = 123;
        $groups = [
            ["id" => "invalidData"]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    public function testSettersWithIncorrectStructure(): void
    {
        $this->expectException(InvalidUserGroupMessageException::class);
        $userId = 123;
        // Invalid array structure
        $groups = [
            [
                UserGroup::ID => 5
            ]
        ];
        $userGroup = UserGroup::create($userId)->setGroups($groups);
    }

    public function testSettersWithIncorrectStructure2(): void
    {
        $this->expectException(InvalidUserGroupMessageException::class);
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
