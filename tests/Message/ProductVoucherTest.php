<?php
namespace Serato\UserProfileSdk\Test\Message;

use Serato\UserProfileSdk\Message\ProductVoucher;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use DateTime;

/**
 * Class ProductVoucherTest
 * @package Serato\UserProfileSdk\Test\Message
 */
class ProductVoucherTest extends PHPUnitTestCase
{
    public function testSettersAndGetters(): void
    {
        $userId        = 123;
        $voucherTypeId = 139;
        $voucherId     = 'SPV-VNRN-GR2R-1111';
        $batchId       = 'VNRN';
        $assignedAt    = '2020-12-02T00:00:00+00:00';
        $redeemedAt    = '2020-12-02T00:00:00+00:00';

        $productVoucher = ProductVoucher::create($userId)
            ->setVoucherId($voucherId)
            ->setVoucherTypeId($voucherTypeId)
            ->setBatchId($batchId)
            ->setAssignedAt(new DateTime($assignedAt))
            ->setRedeemedAt(new DateTime($redeemedAt));

        $this->assertEquals($voucherId, $productVoucher->getVoucherId());
        $this->assertEquals($voucherTypeId, $productVoucher->getVoucherTypeId());
        $this->assertEquals($batchId, $productVoucher->getBatchId());
        $this->assertEquals($assignedAt, $productVoucher->getAssignedAt());
        $this->assertEquals($redeemedAt, $productVoucher->getRedeemedAt());
    }

    public function testNullableGetters(): void
    {
        $productVoucher = ProductVoucher::create(1);
        $this->assertNull($productVoucher->getVoucherId());
        $this->assertNull($productVoucher->getVoucherTypeId());
        $this->assertNull($productVoucher->getBatchId());
        $this->assertNull($productVoucher->getAssignedAt());
        $this->assertNull($productVoucher->getRedeemedAt());
    }
}
