<?php
namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * User profile update.
 * Find information about available options for
 * `DAW`, `hardwares`, `languages` and `countries` at:
 * https://github.com/serato/web-sup-php-app
 */
class UserUpdate extends AbstractMessage
{
    const EMAIL_PARAM_NAME = 'email';
    const DAW_PARAM_NAME = 'daw';
    const HARDWARE_PARAM_NAME = 'hardware';
    const LANGUAGE_PARAM_NAME = 'language';
    const COUNTRY_PARAM_NAME = 'country';

    /**
     * Set user email address
     * @param string $email
     * @return UserUpdate
     */
    public function setEmail($email)
    {
        return $this->setParam(self::EMAIL_PARAM_NAME, $email);
    }

    /**
     * Get user email address
     * @return string
     */
    public function getEmail()
    {
        return $this->getParam(self::EMAIL_PARAM_NAME);
    }

    /**
     * Set user primary DAW option
     * @param string $dawOption
     * @return UserUpdate
     */
    public function setDaw($dawOption)
    {
        return $this->setParam(self::DAW_PARAM_NAME, $dawOption);
    }

    /**
     * Get user primary DAW option
     * @return string
     */
    public function getDaw()
    {
        return $this->getParam(self::DAW_PARAM_NAME);
    }

    /**
     * Set user hardware
     * @param string $hardware
     * @return UserUpdate
     */
    public function setHardware($hardware)
    {
        return $this->setParam(self::HARDWARE_PARAM_NAME, $hardware);
    }

    /**
     * Get user hardware
     * @return string
     */
    public function getHardware()
    {
        return $this->getParam(self::HARDWARE_PARAM_NAME);
    }

    /**
     * Set user language
     * @param string $language
     * @return UserUpdate
     */
    public function setLanguage($language)
    {
        return $this->setParam(self::LANGUAGE_PARAM_NAME, $language);
    }

    /**
     * Get user language
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParam(self::LANGUAGE_PARAM_NAME);
    }

    /**
     * Set user country
     * @param string $country
     * @return UserUpdate
     */
    public function setCountry($country)
    {
        return $this->setParam(self::COUNTRY_PARAM_NAME, $country);
    }

    /**
     * Get user country
     * @return string
     */
    public function getCountry()
    {
        return $this->getParam(self::COUNTRY_PARAM_NAME);
    }
}
