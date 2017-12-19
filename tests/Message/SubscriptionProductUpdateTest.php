<?php
namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\SubscriptionProductUpdate;

class SubscriptionProductUpdateTest extends PHPUnitTestCase
{
    public function testSetters()
    {
        $userId = 123;
        $planName = 'dj-sub';
        $expiryDate = '2016-12-02';

        $subscription = SubscriptionProductUpdate::create($userId)
                        ->setPlan($planName)
                        ->setExpiry($expiryDate);

        $this->assertEquals($planName, $subscription->getPlan());
        $this->assertEquals($expiryDate, $subscription->getExpiry());
    }
}
