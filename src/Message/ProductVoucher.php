<?php

namespace Serato\UserProfileSdk\Message;

use DateTime;

/**
 * Class ProductVoucher
 * @package Serato\UserProfileSdk\Message
 */
class ProductVoucher extends AbstractMessage
{
    public const PARAM_VOUCHER_ID      = 'id';
    public const PARAM_VOUCHER_TYPE_ID = 'type_id';
    public const PARAM_BATCH_ID        = 'batch_id';
    public const PARAM_ASSIGNED_AT     = 'assigned_at';
    public const PARAM_REDEEMED_AT     = 'redeemed_at';

    /**
     * Creates a new message instance
     *
     * @param int   $userId  User ID
     * @param array<array> $params  Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    /**
     * @param string $voucherId
     */
    public function setVoucherId(string $voucherId): self
    {
        $this->setParam(self::PARAM_VOUCHER_ID, $voucherId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVoucherId(): ?string
    {
        return $this->getParam(self::PARAM_VOUCHER_ID);
    }

    /**
     * @param int $voucherTypeId
     * @return $this
     */
    public function setVoucherTypeId(int $voucherTypeId): self
    {
        $this->setParam(self::PARAM_VOUCHER_TYPE_ID, $voucherTypeId);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVoucherTypeId(): ?int
    {
        return $this->getParam(self::PARAM_VOUCHER_TYPE_ID);
    }

    /**
     * @param string $batchId
     * @return $this
     */
    public function setBatchId(string $batchId): self
    {
        $this->setParam(self::PARAM_BATCH_ID, $batchId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBatchId(): ?string
    {
        return $this->getParam(self::PARAM_BATCH_ID);
    }

    /**
     * @param DateTime $assignedAt
     * @return $this
     */
    public function setAssignedAt(DateTime $assignedAt): self
    {
        $this->setParam(self::PARAM_ASSIGNED_AT, $assignedAt->format('c'));
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAssignedAt(): ?string
    {
        return $this->getParam(self::PARAM_ASSIGNED_AT);
    }

    /**
     * @param DateTime|null $redeemedAt
     * @return $this
     */
    public function setRedeemedAt(?DateTime $redeemedAt): self
    {
        if (!is_null($redeemedAt)) {
            $redeemedAt = $redeemedAt->format('c');
        }
        $this->setParam(self::PARAM_REDEEMED_AT, $redeemedAt);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedeemedAt(): ?string
    {
        return $this->getParam(self::PARAM_REDEEMED_AT);
    }
}
