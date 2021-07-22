<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\PermanentLicense;

class PermanentLicenseTest extends PHPUnitTestCase
{
    public function testLicenseImplicitAdd()
    {
        $userId = 123;
        $licenseTypeId = 33;
        $licenseId = 'SDJ-12345-468787-795825';

        $permanentLicense = PermanentLicense::create($userId)
                        ->setLicenseTypeId($licenseTypeId)
                        ->setLicenseId($licenseId)
                        ->setLicenseAction(PermanentLicense::ADD);

        $this->assertEquals('PermanentLicense', $permanentLicense->getType());
        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::ADD, $permanentLicense->getLicenseAction());
    }

    public function testLicenseAddWithoutSettingLicenseAction()
    {
        $userId = 123;
        $licenseTypeId = 33;
        $licenseId = 'SDJ-12345-468787-795825';

        $permanentLicense = PermanentLicense::create($userId)
                        ->setLicenseTypeId($licenseTypeId)
                        ->setLicenseId($licenseId);

        $this->assertEquals('PermanentLicense', $permanentLicense->getType());
        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::ADD, $permanentLicense->getLicenseAction());
    }

    public function testLicenseAddByParams()
    {
        $userId = 123;
        $licenseTypeId = 63;
        $licenseId = 'SDJ-4617621-0063-6213-7710';

        $params = ["license-action" => "license-action-add",
              "license-type-id" => 63,
              "license-id" => "SDJ-4617621-0063-6213-7710"
              ];
        $permanentLicense = PermanentLicense::create($userId, $params);

        $this->assertEquals('PermanentLicense', $permanentLicense->getType());
        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::ADD, $permanentLicense->getLicenseAction());
    }

    public function testLicenseExplicitAdd()
    {
        $userId = 123;
        $licenseTypeId = 33;
        $licenseId = 'SDJ-12345-468787-795825';

        $permanentLicense = PermanentLicense::create($userId)
                        ->setLicenseTypeId($licenseTypeId)
                        ->setLicenseId($licenseId)
                        ->setLicenseAction(PermanentLicense::ADD);

        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::ADD, $permanentLicense->getLicenseAction());
    }

    public function testLicenseRemove()
    {
        $userId = 123;
        $licenseTypeId = 33;
        $licenseId = 'SDJ-12345-468787-795825';
        $permanentLicense = PermanentLicense::create($userId)
                            ->setLicenseTypeId($licenseTypeId)
                            ->setLicenseId($licenseId)
                            ->setLicenseAction(PermanentLicense::REMOVE);

        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::REMOVE, $permanentLicense->getLicenseAction());
    }

    public function testLicenseRemoveByParams()
    {
        $userId = 123;
        $licenseTypeId = 63;
        $licenseId = 'SDJ-4617621-0063-6213-7710';

        $params = ["license-action" => "license-action-remove",
              "license-type-id" => 63,
              "license-id" => "SDJ-4617621-0063-6213-7710"
              ];
        $permanentLicense = PermanentLicense::create($userId, $params);

        $this->assertEquals('PermanentLicense', $permanentLicense->getType());
        $this->assertEquals($licenseTypeId, $permanentLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $permanentLicense->getLicenseId());
        $this->assertEquals(PermanentLicense::REMOVE, $permanentLicense->getLicenseAction());
    }
}
