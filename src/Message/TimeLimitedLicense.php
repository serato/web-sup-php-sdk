<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user adding or removing a time limited license.
 */
class TimeLimitedLicense extends AbstractMessage
{
    protected const LICENSE_TYPE_ID = 'license-type-id';
    protected const LICENSE_ID = 'license-id';
    protected const LICENSE_ACTION = 'license-action';
    public const ADD = 'license-action-add';
    public const REMOVE = 'license-action-remove';
    protected const EXPIRY = 'expiry';

    /**
     * {@inheritdoc}
     */
    public function __construct(int $userId, array $params = [])
    {
        parent::__construct($userId, $params);
        if ($this->getLicenseAction() === null) {
            $this->setLicenseAction(self::ADD);
        }
    }

    /**
     * Creates a new message instance
     *
     * @param int   $userId    User ID
     * @param array<string, mixed> $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    /**
     * Set the license type id
     *
     * @param int $licenseTypeId
     * @return self
     */
    public function setLicenseTypeId(int $licenseTypeId): self
    {
        $this->setParam(self::LICENSE_TYPE_ID, $licenseTypeId);
        return $this;
    }

    /**
     * Get the license type id
     *
     * @return null | int
     */
    public function getLicenseTypeId(): ?int
    {
        return $this->getParam(self::LICENSE_TYPE_ID);
    }

    /**
     * Set the license id
     *
     * @param string $licenseId
     * @return self
     */
    public function setLicenseId(string $licenseId): self
    {
        $this->setParam(self::LICENSE_ID, $licenseId);
        return $this;
    }

    /**
     * Get the license id
     *
     * @return null | string
     */
    public function getLicenseId(): ?string
    {
        return $this->getParam(self::LICENSE_ID);
    }

    /**
     * Set the license action
     *
     * @param string $action
     * @return self
     */
    public function setLicenseAction(string $action): self
    {
        $this->setParam(self::LICENSE_ACTION, $action);
        return $this;
    }

    /**
     * Get the license action
     *
     * @return null | string
     */
    public function getLicenseAction(): ?string
    {
        return $this->getParam(self::LICENSE_ACTION);
    }

    /**
     * Set the expiry date for Time Limited License
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @param string    $expiryDate    Time Limited License expiry date
     * @return self
     */
    public function setExpiry(string $expiryDate): self
    {
        $this->setParam(self::EXPIRY, $expiryDate);
        return $this;
    }

    /**
     * Get the expiry date for Time Limited License
     *
     * @return null | string
     */
    public function getExpiry(): ?string
    {
        return $this->getParam(self::EXPIRY);
    }

    /**
     * Set expiry timestamp for Time Limited License
     *
     * @param int $timestamp
     * @return self
     */
    public function setExpiryTimestamp(int $timestamp): self
    {
        $this->setExpiry(gmdate(DATE_ATOM, $timestamp));
        return $this;
    }
}
