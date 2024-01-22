<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\SoundPackDownload;

class SoundPackDownloadTest extends PHPUnitTestCase
{
    public function testSetters(): void
    {
        $userId = 123;
        $soundPackName = 'Organic House Vol. 1';
        $downloadAt = "2019-09-16T00:00:00+00:00";

        $soundDownload = SoundPackDownload::create($userId)
                        ->setSoundPackName($soundPackName)
                        ->setDownloadAt($downloadAt);

        $this->assertEquals('SoundPackDownload', $soundDownload->getType());
        $this->assertEquals($soundPackName, $soundDownload->getSoundPackName());
        $this->assertEquals($downloadAt, $soundDownload->getDownloadAt());
    }
}
