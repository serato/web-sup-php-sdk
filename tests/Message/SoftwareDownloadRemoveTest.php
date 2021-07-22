<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\SoftwareDownloadRemove;

class SoftwareDownloadRemoveTest extends PHPUnitTestCase
{
    public function testSetters()
    {
        $userId = 123;
        $software = 'dj-sub';
        $os = 'mac';
        $version = '1.9.10';

        $softwareDownloadRemove = SoftwareDownloadRemove::create($userId)
                        ->setSoftwareName($software)
                        ->setOS($os)
                        ->setVersion($version);

        $this->assertEquals('SoftwareDownloadRemove', $softwareDownloadRemove->getType());
        $this->assertEquals($software, $softwareDownloadRemove->getSoftwareName());
        $this->assertEquals($os, $softwareDownloadRemove->getOS());
        $this->assertEquals($version, $softwareDownloadRemove->getVersion());
    }
}
