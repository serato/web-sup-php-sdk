<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * User's subscription products.
 * Find information about available
 * options for `plan` and `expiry` at:
 * https://github.com/serato/web-sup-php-app
 */
class SubscriptionProductUpdate extends AbstractMessage
{
    const SUB_PLAN_PARAM_NAME = 'plan';
    const SUB_EXPIRY_PARAM_NAME = 'expiry';

    /**
     * Set plan name for subscription
     * @param string $planName
     * @return SubscriptionProductUpdate
     */
    public function setPlan($planName)
    {
        return $this->setParam(self::SUB_PLAN_PARAM_NAME, $planName);
    }

    /**
     * Get subscription plan name
     * @return string
     */
    public function getPlan()
    {
        return $this->getParam(self::SUB_PLAN_PARAM_NAME);
    }

    /**
     * Set expiry date for subscription
     * @param string $expiryDate
     * @return SubscriptionProductUpdate
     */
    public function setExpiry($expiryDate)
    {
        return $this->setParam(self::SUB_EXPIRY_PARAM_NAME, $expiryDate);
    }

    /**
     * Get expiry date for subscription
     * @return string
     */
    public function getExpiry()
    {
        return $this->getParam(self::SUB_EXPIRY_PARAM_NAME);
    }
}
