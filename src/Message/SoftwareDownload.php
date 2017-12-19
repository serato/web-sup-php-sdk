<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * User's downloaded softwares.
 * Find information about available options
 * for `software`, `OS` and `version` at:
 * https://github.com/serato/web-sup-php-app
 */
class SoftwareDownload extends AbstractMessage
{
    const SOFTWARE_PARAM_NAME = 'software';
    const SOFTWARE_VER_PARAM_NAME = 'version';
    const SOFTWARE_OS_PARAM_NAME = 'os';

    /**
     * Add software to user
     * @param string $software
     * @return SoftwareDownload
     */
    public function add($software)
    {
        return $this->setParam(self::SOFTWARE_PARAM_NAME, $software);
    }

    /**
     * Get downloaded software
     * @return string
     */
    public function getSoftware()
    {
        return $this->getParam(self::SOFTWARE_PARAM_NAME);
    }

    /**
     * Set Operating System for downloaded software
     * @param string $os
     * @return SoftwareDownload
     */
    public function setOS($os)
    {
        return $this->setParam(self::SOFTWARE_OS_PARAM_NAME, $os);
    }

    /**
     * Get Operating System for downloaded software
     * @return string
     */
    public function getOS()
    {
        return $this->getParam(self::SOFTWARE_OS_PARAM_NAME);
    }

    /**
     * Set version for downloaded software
     * @param string $version
     * @return SoftwareDownload
     */
    public function setVersion($version)
    {
        return $this->setParam(self::SOFTWARE_VER_PARAM_NAME, $version);
    }

    /**
     * Get version for downloaded software
     * @return string
     */
    public function getVersion()
    {
        return $this->getParam(self::SOFTWARE_VER_PARAM_NAME);
    }
}
