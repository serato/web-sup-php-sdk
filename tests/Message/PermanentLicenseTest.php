<?php
namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\PermanentLicense;

class PermanentLicenseTest extends PHPUnitTestCase
{
    public function testLicenseAdd()
    {
        $userId = 123;
        $licenseId = '33';

        $permanentLicense = PermanentLicense::create($userId)
                        ->add($licenseId);

        $this->assertEquals($licenseId, $permanentLicense->getAddedLicense());
    }

    public function testLicenseRemove()
    {
        $userId = 123;
        $licenseId = '32';
        $permanentLicense = PermanentLicense::create($userId)
                            ->remove($licenseId);

        $this->assertEquals($licenseId, $permanentLicense->getRemovedLicense());
    }
}
