<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * User's trial products.
 * Find information about available options
 * for `productId` and `expiry` at:
 * https://github.com/serato/web-sup-php-app
 */
class TrialProductUpdate extends AbstractMessage
{
    const TRIAL_PRODUCT_PARAM_NAME = 'trial-product';
    const TRIAL_PRODUCT_EXPIRY_PARAM_NAME = 'expiry';

    /**
     * Set trial product id
     * @param string $productId
     * @return TrialProductUpdate
     */
    public function setProductId($productId)
    {
        return $this->setParam(self::TRIAL_PRODUCT_PARAM_NAME, $productId);
    }

    /**
     * Get trial product id
     * @return string
     */
    public function getProductId()
    {
        return $this->getParam(self::TRIAL_PRODUCT_PARAM_NAME);
    }

    /**
     * Set expiry date for trial product
     * @param string $expiryDate
     * @return TrialProductUpdate
     */
    public function setExpiry($expiryDate)
    {
        return $this->setParam(self::TRIAL_PRODUCT_EXPIRY_PARAM_NAME, $expiryDate);
    }

    /**
     * Get trial expiry
     * @return string
     */
    public function getExpiry()
    {
        return $this->getParam(self::TRIAL_PRODUCT_EXPIRY_PARAM_NAME);
    }
}
