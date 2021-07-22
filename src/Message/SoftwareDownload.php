<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user downloading a software installer.
 */
class SoftwareDownload extends AbstractMessage
{
    const SOFTWARE_NAME = 'software';
    const VERSION = 'version';
    const OS = 'os';
    const RELEASE_TYPE = 'release_type';

    /**
     * Creates a new message instance
     *
     * @param int   $userId      User ID
     * @param array $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        return new static($userId, $params);
    }

    /**
     * Set the name of the software download
     *
     * @param string    $software   Software name
     * @return self
     */
    public function setSoftwareName(string $software): self
    {
        $this->setParam(self::SOFTWARE_NAME, $software);
        return $this;
    }

    /**
     * Get the name of the software download
     *
     * @return null | string
     */
    public function getSoftwareName(): ?string
    {
        return $this->getParam(self::SOFTWARE_NAME);
    }

    /**
     * Set the operating system of the software download
     *
     * @param string    $os    Operating system
     * @return self
     */
    public function setOS(string $os): self
    {
        $this->setParam(self::OS, $os);
        return $this;
    }

    /**
     * Get the operating system of the software download
     *
     * @return null | string
     */
    public function getOS(): ?string
    {
        return $this->getParam(self::OS);
    }

    /**
     * Set the version of the software download.
     *
     * Version is specified in the format `major.minor.point.build`.
     *
     * eg. `1.0.1.12321`, `1.20.5.226`, `2.1.11.55`
     *
     * @param   string  $version    Software version
     *
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->setParam(self::VERSION, $version);
        return $this;
    }

    /**
     * Get the version of the software download
     *
     * @return null | string
     */
    public function getVersion(): ?string
    {
        return $this->getParam(self::VERSION);
    }

    /**
     * Set the release type of the software download
     *
     * eg. `release`, `publicbeta`, `privatebeta`
     *
     * @param   string  $type
     * @return  self
     */
    public function setReleaseType(string $type): self
    {
        $this->setParam(self::RELEASE_TYPE, $type);
        return $this;
    }

    /**
     * Get the release type of the software download
     *
     * @return null | string
     */
    public function getReleaseType(): ?string
    {
        return $this->getParam(self::RELEASE_TYPE);
    }
}
