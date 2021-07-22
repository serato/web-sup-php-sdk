<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user's subscription plan.
 *
 * The message conveys the user starting the plan for the first time, as well as
 * indicating that the expiry date of the plan has changed.
 */
class SubscriptionProductUpdate extends AbstractMessage
{
    private const PLAN = 'plan';
    private const EXPIRY = 'expiry';
    private const STATUS = 'status';
    private const NUMBER_OF_BILLING_CYCLES = 'numberOfBillingCycles';
    private const CURRENT_BILLING_CYCLE = 'currentBillingCycle';

    /**
     * Creates a new message instance
     *
     * @param int   $userId    User ID
     * @param array $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        return new static($userId, $params);
    }

    /**
     * Set the number of billing cycles for Subscription
     *
     * @param int   $numberOfBillingCycles  Subscription Number Of Billing Cycles
     * @return self
     */
    public function setNumberOfBillingCycles(int $numberOfBillingCycles): self
    {
        $this->setParam(self::NUMBER_OF_BILLING_CYCLES, $numberOfBillingCycles);
        return $this;
    }

    /**
     * Get the number of billing cycles for Subscription
     *
     * @return null | int
     */
    public function getNumberOfBillingCycles(): ?int
    {
        return $this->getParam(self::NUMBER_OF_BILLING_CYCLES);
    }

    /**
     * Set the current billing cycle for Subscription
     *
     * @param int    $currentBillingCycle  Subscription current billing cycle
     * @return self
     */
    public function setCurrentBillingCycle(int $currentBillingCycle): self
    {
        $this->setParam(self::CURRENT_BILLING_CYCLE, $currentBillingCycle);
        return $this;
    }

    /**
     * Get the current billing cycle for Subscription
     *
     * @return null | int
     */
    public function getCurrentBillingCycle(): ?int
    {
        return $this->getParam(self::CURRENT_BILLING_CYCLE);
    }

    /**
     * Set the status for Subscription
     *
     * @param string    $status  Subscription status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->setParam(self::STATUS, $status);
        return $this;
    }

    /**
     * Get the status for Subscription
     *
     * @return null | string
     */
    public function getStatus(): ?string
    {
        return $this->getParam(self::STATUS);
    }

    /**
     * Set the plan name for Subscription
     *
     * @param string    $planName  Subscription plan name
     * @return self
     */
    public function setPlan(string $planName): self
    {
        $this->setParam(self::PLAN, $planName);
        return $this;
    }

    /**
     * Get the plan name for Subscription
     *
     * @return null | string
     */
    public function getPlan(): ?string
    {
        return $this->getParam(self::PLAN);
    }

    /**
     * Set the expiry date for Subscription
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @param string    $expiryDate    Subscription expiry date
     * @return self
     */
    public function setExpiry(string $expiryDate): self
    {
        $this->setParam(self::EXPIRY, $expiryDate);
        return $this;
    }

    /**
     * Get the expiry date for Subscription
     *
     * @return null | string
     */
    public function getExpiry(): ?string
    {
        return $this->getParam(self::EXPIRY);
    }

    /**
     * Set expiry timestamp for subscription
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
