<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user updating profile information.
 *
 * Each message can convey the updating of all possible parameters or subset
 * of parameters including individual parameters.
 */
class UserUpdate extends AbstractMessage
{
    public const EMAIL = 'email';
    public const DAW = 'daw';
    public const HAS_DJ_HARDWARE = 'dj_hardware';
    public const LANGUAGE = 'language';
    public const COUNTRY = 'country';
    public const GLOBAL_CONTACT_ME = 'global_contact_me';
    public const IMPLICIT_OPT_OUT = 0;
    public const IMPLICIT_OPT_IN = 1;
    public const EXPLICIT_OPT_OUT = 2;
    public const EXPLICIT_OPT_IN = 3;
    public const NO_VALUE_CONTACT_ME = 4;

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
     * Set user email address
     *
     * @param string    $email  Email address
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->setParam(self::EMAIL, $email);
        return $this;
    }

    /**
     * Get user email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getParam(self::EMAIL);
    }

    /**
     * Set user primary DAW option
     *
     * @param string $dawOption
     * @return self
     */
    public function setDaw(string $dawOption): self
    {
        $this->setParam(self::DAW, $dawOption);
        return $this;
    }

    /**
     * Get user primary DAW option
     *
     * @return null | string
     */
    public function getDaw(): ?string
    {
        return $this->getParam(self::DAW);
    }

    /**
     * Sets whether or not the user has DJ hardware
     *
     * @param bool $hardware
     * @return self
     */
    public function setHasDjHardware(bool $hardware): self
    {
        $this->setParam(self::HAS_DJ_HARDWARE, $hardware);
        return $this;
    }

    /**
     * Returns whether or not the user has DJ hardware
     *
     * @return null | bool
     */
    public function getHasDjHardware(): ?bool
    {
        return $this->getParam(self::HAS_DJ_HARDWARE);
    }

    /**
     * Set user language
     *
     * @param string $language
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->setParam(self::LANGUAGE, $language);
        return $this;
    }

    /**
     * Get user language
     *
     * @return null | string
     */
    public function getLanguage(): ?string
    {
        return $this->getParam(self::LANGUAGE);
    }

    /**
     * Set user country
     *
     * @param string $country
     * @return self
     */
    public function setCountry(string $country): self
    {
        $this->setParam(self::COUNTRY, $country);
        return $this;
    }

    /**
     * Get user country
     *
     * @return null | string
     */
    public function getCountry(): ?string
    {
        return $this->getParam(self::COUNTRY);
    }

    /**
     * Set notification setting
     *
     * @param int $globalContactMe This value should be one of:
     *      self::IMPLICIT_OPT_OUT
     *      self::IMPLICIT_OPT_IN
     *      self::EXPLICIT_OPT_OUT
     *      self::EXPLICIT_OPT_IN
     *      self::NO_VALUE_CONTACT_ME
     * @return self
     */
    public function setGlobalContactMe(int $globalContactMe): self
    {
        $this->setParam(self::GLOBAL_CONTACT_ME, $globalContactMe);
        return $this;
    }

    /**
     * Get notification setting
     *
     * @return null | int
     */
    public function getGlobalContactMe(): ?int
    {
        return $this->getParam(self::GLOBAL_CONTACT_ME);
    }
}
