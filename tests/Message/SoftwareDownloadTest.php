<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\SoftwareDownload;

class SoftwareDownloadTest extends PHPUnitTestCase
{
    public function testSetters(): void
    {
        $userId = 123;
        $software = 'dj-sub';
        $os = 'mac';
        $releaseType = 'private_beta';
        $version = '1.9.10';

        $softwareDownload = SoftwareDownload::create($userId)
                        ->setSoftwareName($software)
                        ->setOS($os)
                        ->setReleaseType($releaseType)
                        ->setVersion($version);

        $this->assertEquals('SoftwareDownload', $softwareDownload->getType());
        $this->assertEquals($software, $softwareDownload->getSoftwareName());
        $this->assertEquals($os, $softwareDownload->getOS());
        $this->assertEquals($version, $softwareDownload->getVersion());
        $this->assertEquals($releaseType, $softwareDownload->getReleaseType());
    }
}
