<?php
namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\UserUpdate;

class UserUpdateTest extends PHPUnitTestCase
{
    public function testSetters()
    {
        $userId = 123;
        $email = 'test@serato.com';
        $daw = 'dawOption';
        $hardware = 'intro';
        $language = 'en';
        $country = 'US';

        $userUpdate = UserUpdate::create($userId)
                        ->setEmail($email)
                        ->setDaw($daw)
                        ->setHardware($hardware)
                        ->setLanguage($language)
                        ->setCountry($country);

        $this->assertEquals($email, $userUpdate->getEmail());
        $this->assertEquals($daw, $userUpdate->getDaw());
        $this->assertEquals($hardware, $userUpdate->getHardware());
        $this->assertEquals($language, $userUpdate->getLanguage());
        $this->assertEquals($country, $userUpdate->getCountry());
    }
}
