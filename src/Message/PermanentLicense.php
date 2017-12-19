<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * User's permanent licenses.
 * Find information about available options
 * for `licenseId`
 * https://github.com/serato/web-sup-php-app
 */
class PermanentLicense extends AbstractMessage
{
    const LICENSE_ADD_PARAM_NAME = 'added-license';
    const LICENSE_REMOVE_PARAM_NAME = 'removed-license';

    /**
     * Add license to user
     * @param string $licenseId
     * @return PermanentLicense
     */
    public function add($licenseId)
    {
        return $this->setParam(self::LICENSE_ADD_PARAM_NAME, $licenseId);
    }

    /**
     * Get added license
     * @return string
     */
    public function getAddedLicense()
    {
        return $this->getParam(self::LICENSE_ADD_PARAM_NAME);
    }

    /**
     * Remove license from user
     * @param string $licenseId
     * @return PermanentLicense
     */
    public function remove($licenseId)
    {
        return $this->setParam(self::LICENSE_REMOVE_PARAM_NAME, $licenseId);
    }

    /**
     * Get removed license
     * @return string
     */
    public function getRemovedLicense()
    {
        return $this->getParam(self::LICENSE_REMOVE_PARAM_NAME);
    }
}
