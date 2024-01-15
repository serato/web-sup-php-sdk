<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\TrialProductUpdate;

class TrialProductUpdateTest extends PHPUnitTestCase
{
    public function testSetters0(): void
    {
        $userId = 123;
        $productName = 'sample';
        $expiryDate = '2016-12-02T00:00:00+00:00';

        $trialProduct = TrialProductUpdate::create($userId)
                        ->setProductName($productName)
                        ->setExpiry($expiryDate);

        $this->assertEquals('TrialProductUpdate', $trialProduct->getType());
        $this->assertEquals($productName, $trialProduct->getProductName());
        $this->assertEquals($expiryDate, $trialProduct->getExpiry());
    }

    public function testSetters1(): void
    {
        $userId = 123;
        $productName = 'sample';
        $expiryTimestamp = 1480636800;
        $expiryDate = '2016-12-02T00:00:00+00:00';

        $trialProduct = TrialProductUpdate::create($userId)
            ->setProductName($productName)
            ->setExpiryTimestamp($expiryTimestamp);

        $this->assertEquals('TrialProductUpdate', $trialProduct->getType());
        $this->assertEquals($productName, $trialProduct->getProductName());
        $this->assertEquals($expiryDate, $trialProduct->getExpiry());
    }
}
