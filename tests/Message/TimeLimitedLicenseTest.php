<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use DateTime;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\TimeLimitedLicense;

class TimeLimitedLicenseTest extends PHPUnitTestCase
{
    public function testTimeLimitedLicenseImplicitAdd()
    {
        $userId = 123;
        $licenseTypeId = 61;
        $licenseId = 'TLL-12345-468787-795825';
        $expiryDate = '2016-12-02T00:00:00+00:00';

        $timeLimitedLicense = TimeLimitedLicense::create($userId)
            ->setLicenseTypeId($licenseTypeId)
            ->setLicenseId($licenseId)
            ->setExpiry($expiryDate);

        $this->assertEquals('TimeLimitedLicense', $timeLimitedLicense->getType());
        $this->assertEquals($licenseTypeId, $timeLimitedLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $timeLimitedLicense->getLicenseId());
        $this->assertEquals(TimeLimitedLicense::ADD, $timeLimitedLicense->getLicenseAction());
        $this->assertEquals($expiryDate, $timeLimitedLicense->getExpiry());
    }

    public function testTimeLimitedLicenseExplicitAdd()
    {
        $userId = 123;
        $licenseTypeId = 62;
        $now = new DateTime();
        $expiryTimestamp = $now->getTimestamp();
        $expiryDate = $now->format(DateTime::ATOM);
        $licenseId = 'TLL-12345-468787-795825';

        $timeLimitedLicense = TimeLimitedLicense::create($userId)
            ->setLicenseTypeId($licenseTypeId)
            ->setLicenseId($licenseId)
            ->setLicenseAction(TimeLimitedLicense::ADD)
            ->setExpiryTimestamp($expiryTimestamp);

        $this->assertEquals('TimeLimitedLicense', $timeLimitedLicense->getType());
        $this->assertEquals($licenseTypeId, $timeLimitedLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $timeLimitedLicense->getLicenseId());
        $this->assertEquals(TimeLimitedLicense::ADD, $timeLimitedLicense->getLicenseAction());
        $this->assertEquals($expiryDate, $timeLimitedLicense->getExpiry());
    }

    public function testTimeLimitedLicenseRemove()
    {
        $userId = 123;
        $licenseTypeId = 61;
        $now = new DateTime();
        $expiryTimestamp = $now->getTimestamp();
        $expiryDate = $now->format(DateTime::ATOM);
        $licenseId = 'TLL-12345-468787-795825';

        $timeLimitedLicense = TimeLimitedLicense::create($userId)
            ->setLicenseTypeId($licenseTypeId)
            ->setLicenseId($licenseId)
            ->setLicenseAction(TimeLimitedLicense::REMOVE)
            ->setExpiryTimestamp($expiryTimestamp);

        $this->assertEquals('TimeLimitedLicense', $timeLimitedLicense->getType());
        $this->assertEquals($licenseTypeId, $timeLimitedLicense->getLicenseTypeId());
        $this->assertEquals($licenseId, $timeLimitedLicense->getLicenseId());
        $this->assertEquals(TimeLimitedLicense::REMOVE, $timeLimitedLicense->getLicenseAction());
        $this->assertEquals($expiryDate, $timeLimitedLicense->getExpiry());
    }
}
