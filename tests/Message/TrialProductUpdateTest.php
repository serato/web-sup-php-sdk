<?php
namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\TrialProductUpdate;

class TrialProductUpdateTest extends PHPUnitTestCase
{
    public function testSetters()
    {
        $userId = 123;
        $productId = '14';
        $expiryDate = '2016-12-02';

        $trialProduct = TrialProductUpdate::create($userId)
                        ->setProductId($productId)
                        ->setExpiry($expiryDate);

        $this->assertEquals($productId, $trialProduct->getProductId());
        $this->assertEquals($expiryDate, $trialProduct->getExpiry());
    }
}
