<?php
namespace Serato\UserProfileSdk\Test\Message;

use Serato\UserProfileSdk\Message\ProductVoucherAssign;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * Class ProductVoucherAssignTest
 * @package Serato\UserProfileSdk\Test\Message
 */
class ProductVoucherAssignTest extends PHPUnitTestCase
{
    public function testSettersAndGetters(): void
    {
        $userId        = 123;
        $voucherTypeId = 139;
        $voucherId     = 'SPV-VNRN-GR2R-1111';
        $batchId       = 'VNRN';
        $assignedAt    = '2021-05-02T00:00:00+:00:00';
        $redeemedAt    = '2021-05-02T00:00:00+:00:00';

        $productVoucher = ProductVoucherAssign::create($userId)
            ->setVoucherId($voucherId)
            ->setVoucherTypeId($voucherTypeId)
            ->setBatchId($batchId)
            ->setAssignedAt($assignedAt)
            ->setRedeemedAt($redeemedAt);

        $this->assertEquals($voucherId, $productVoucher->getVoucherId());
        $this->assertEquals($voucherTypeId, $productVoucher->getVoucherTypeId());
        $this->assertEquals($batchId, $productVoucher->getBatchId());
        $this->assertEquals($assignedAt, $productVoucher->getAssignedAt());
        $this->assertEquals($redeemedAt, $productVoucher->getRedeemedAt());
    }
}
