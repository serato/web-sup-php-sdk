<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user adding or removing a software permanent license.
 */
class PermanentLicense extends AbstractMessage
{
    const LICENSE_TYPE_ID = 'license-type-id';
    const LICENSE_ID = 'license-id';
    const LICENSE_ACTION = 'license-action';

    const ADD = 'license-action-add';
    const REMOVE = 'license-action-remove';

    /**
     * {@inheritdoc}
     */
    public function __construct($userId, array $params = [])
    {
        parent::__construct($userId, $params);
        if ($this->getLicenseAction() === null) {
            $this->setLicenseAction(self::ADD);
        }
    }

    /**
     * Set the license type id
     *
     * @param int $licenseTypeId
     * @return self
     */
    public function setLicenseTypeId($licenseTypeId)
    {
        return $this->setParam(self::LICENSE_TYPE_ID, $licenseTypeId);
    }

    /**
     * Get the license type id
     *
     * @return int
     */
    public function getLicenseTypeId()
    {
        return $this->getParam(self::LICENSE_TYPE_ID);
    }

    /**
     * Set the license action
     *
     * @param string $action
     * @return self
     */
    public function setLicenseAction($action)
    {
        return $this->setParam(self::LICENSE_ACTION, $action);
    }

    /**
     * Get the license action
     *
     * @return string
     */
    public function getLicenseAction()
    {
        return $this->getParam(self::LICENSE_ACTION);
    }

    /**
     * Set the license id
     *
     * @param string $licenseId
     * @return self
     */
    public function setLicenseId($licenseId)
    {
        return $this->setParam(self::LICENSE_ID, $licenseId);
    }

    /**
     * Get the license id
     *
     * @return string
     */
    public function getLicenseId()
    {
        return $this->getParam(self::LICENSE_ID);
    }
}
