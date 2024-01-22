<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use DateTime;
use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user downloading a sound installer.
 */
class SoundPackDownload extends AbstractMessage
{
    private const SOUND_PACK_NAME = 'sound_pack_name';
    private const DOWNLOAD_AT = 'download_at';

    /**
     * {@inheritdoc}
     */
    public function __construct(int $userId, array $params = [])
    {
        parent::__construct($userId, $params);
        if ($this->getDownloadAt() === null) {
            $this->setDownloadAt((new DateTime('NOW'))->format(DateTime::ATOM));
        }
    }

    /**
     * Creates a new message instance
     *
     * @param int   $userId      User ID
     * @param array<string, mixed> $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    /**
     * Set the name of the soundPack download
     *
     * @param string    $soundPackName   Sound pack name
     * @return self
     */
    public function setSoundPackName(string $soundPackName): self
    {
        $this->setParam(self::SOUND_PACK_NAME, $soundPackName);
        return $this;
    }

    /**
     * Get the name of the soundPack download
     *
     * @return null | string
     */
    public function getSoundPackName(): ?string
    {
        return $this->getParam(self::SOUND_PACK_NAME);
    }

    /**
     * Set the download date of the soundPack download
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @param   string  $date
     * @return  self
     */
    public function setDownloadAt(string $date): self
    {
        $this->setParam(self::DOWNLOAD_AT, $date);
        return $this;
    }

    /**
     * Get the download date of the soundPack download
     *
     * @return null | string
     */
    public function getDownloadAt(): ?string
    {
        return $this->getParam(self::DOWNLOAD_AT);
    }
}
