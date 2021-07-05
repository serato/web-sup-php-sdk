<?php
namespace Serato\UserProfileSdk\Message;

/**
 * Class ProductVoucherAssign
 * @package Serato\UserProfileSdk\Message
 */
class ProductVoucherAssign extends AbstractMessage
{
    private const PARAM_VOUCHER_ID      = 'id';
    private const PARAM_VOUCHER_TYPE_ID = 'type_id';
    private const PARAM_BATCH_ID        = 'batch_id';
    private const PARAM_ASSIGNED_AT     = 'assigned_at';
    private const PARAM_REDEEMED_AT     = 'redeemed_at';

    /**
     * Creates a new message instance
     *
     * @param int   $userId  User ID
     * @param array $params  Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
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
     * @param string $assignedAt
     * @return $this
     */
    public function setAssignedAt(string $assignedAt): self
    {
        $this->setParam(self::PARAM_ASSIGNED_AT, $assignedAt);
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
     * @param string $updatedAt
     * @return $this
     */
    public function setRedeemedAt(string $updatedAt): self
    {
        $this->setParam(self::PARAM_REDEEMED_AT, $updatedAt);
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