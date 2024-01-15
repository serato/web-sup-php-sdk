<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user starting a trial of a product.
 *
 * The product may be being trialled for the first time, or for successive times
 * in which case the expiry date of the product will be updated.
 */
class TrialProductUpdate extends AbstractMessage
{
    private const PRODUCT_NAME = 'trial-product';
    private const EXPIRY = 'expiry';

    /**
     * Creates a new message instance
     *
     * @param int   $userId    User ID
     * @param array<array> $params      Array of message parameters
     */
    public static function create(int $userId, array $params = [])
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    /**
     * Set the trial Product Type name
     *
     * @param string $productName    Trial Product name
     * @return self
     */
    public function setProductName(string $productName): self
    {
        $this->setParam(self::PRODUCT_NAME, $productName);
        return $this;
    }

    /**
     * Get trial Product Type name
     *
     * @return null | string
     */
    public function getProductName(): ?string
    {
        return $this->getParam(self::PRODUCT_NAME);
    }

    /**
     * Set expiry date for trial Product.
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @param string $expiryDate    Trial expiry date
     * @return self
     */
    public function setExpiry(string $expiryDate): self
    {
        $this->setParam(self::EXPIRY, $expiryDate);
        return $this;
    }

    /**
     * Get expiry date for trial Product.
     *
     * @return string
     */
    public function getExpiry(): ?string
    {
        return $this->getParam(self::EXPIRY);
    }

    /**
     * Set expiry timestamp for trial
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
