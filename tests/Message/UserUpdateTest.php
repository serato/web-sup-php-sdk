<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\UserUpdate;

class UserUpdateTest extends PHPUnitTestCase
{
    public function testSetters(): void
    {
        $userId = 123;
        $email = 'test@serato.com';
        $daw = 'dawOption';
        $hardware = true;
        $language = 'en';
        $country = 'US';
        $mcHistoricalSubscribed = false;
        $globalContactMe = 3;

        $userUpdate = UserUpdate::create($userId)
                        ->setEmail($email)
                        ->setDaw($daw)
                        ->setHasDjHardware($hardware)
                        ->setLanguage($language)
                        ->setCountry($country)
                        ->setGlobalContactMe($globalContactMe);

        $this->assertEquals('UserUpdate', $userUpdate->getType());
        $this->assertEquals($email, $userUpdate->getEmail());
        $this->assertEquals($daw, $userUpdate->getDaw());
        $this->assertEquals($hardware, $userUpdate->getHasDjHardware());
        $this->assertEquals($language, $userUpdate->getLanguage());
        $this->assertEquals($country, $userUpdate->getCountry());
        $this->assertEquals($globalContactMe, $userUpdate->getGlobalContactMe());
    }
}
