<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\SubscriptionProductUpdate;

class SubscriptionProductUpdateTest extends PHPUnitTestCase
{
    public function testSetters0(): void
    {
        $userId = 123;
        $planName = 'dj-sub';
        $expiryDate = '2016-12-02T00:00:00+00:00';
        $status = 'active';
        $numberOfBillingCycles = 4;
        $currentBillingCycle = 4;

        $subscription = SubscriptionProductUpdate::create($userId)
                        ->setPlan($planName)
                        ->setExpiry($expiryDate)
                        ->setStatus($status)
                        ->setNumberOfBillingCycles($numberOfBillingCycles)
                        ->setCurrentBillingCycle($currentBillingCycle);

        $this->assertEquals('SubscriptionProductUpdate', $subscription->getType());
        $this->assertEquals($planName, $subscription->getPlan());
        $this->assertEquals($expiryDate, $subscription->getExpiry());
        $this->assertEquals($status, $subscription->getStatus());
        $this->assertEquals($numberOfBillingCycles, $subscription->getNumberOfBillingCycles());
        $this->assertEquals($currentBillingCycle, $subscription->getCurrentBillingCycle());
    }

    public function testSetters1(): void
    {
        $userId = 123;
        $planName = 'dj-sub';
        $expiryTimestamp = 1480636800;
        $expiryDate = '2016-12-02T00:00:00+00:00';
        $status = 'active';
        $numberOfBillingCycles = 4;
        $currentBillingCycle = 4;

        $subscription = SubscriptionProductUpdate::create($userId)
            ->setPlan($planName)
            ->setExpiryTimestamp($expiryTimestamp)
            ->setStatus($status)
            ->setNumberOfBillingCycles($numberOfBillingCycles)
            ->setCurrentBillingCycle($currentBillingCycle);

        $this->assertEquals('SubscriptionProductUpdate', $subscription->getType());
        $this->assertEquals($planName, $subscription->getPlan());
        $this->assertEquals($status, $subscription->getStatus());
        $this->assertEquals($expiryDate, $subscription->getExpiry());
        $this->assertEquals($numberOfBillingCycles, $subscription->getNumberOfBillingCycles());
        $this->assertEquals($currentBillingCycle, $subscription->getCurrentBillingCycle());
    }
}
