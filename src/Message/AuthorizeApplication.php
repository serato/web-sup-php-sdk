<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing an application authorization
 */
class AuthorizeApplication extends AbstractMessage
{
    const APP_NAME = 'app-name';
    const AUTHORIZATION_TIME = 'authorization-time';

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
     * Gets the name of the app that has been authorized
     *
     * @return string|null
     */
    public function getAppName(): ?string
    {
        return $this->getParam(self::APP_NAME);
    }

    /**
     * Sets the name of the app that has been authorized
     *
     * @param string $appName
     * @return self
     */
    public function setAppName(string $appName): self
    {
        $this->setParam(self::APP_NAME, $appName);
        return $this;
    }

    /**
     * Gets the time that the app has been authorized
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @return string|null
     */
    public function getAuthorizationTime(): ?string
    {
        return $this->getParam(self::AUTHORIZATION_TIME);
    }

    /**
     * Sets the time that the app has been authorized
     *
     * Date format: DATE_ATOM
     * Example: 2017-08-15T15:52:01+00:00
     *
     * @param string $authorizationTime Time that the authorization was made
     * @return self
     */
    public function setAuthorizationTime(string $authorizationTime): self
    {
        $this->setParam(self::AUTHORIZATION_TIME, $authorizationTime);
        return $this;
    }

    /**
     * Sets the authorization time as a UNIX time stamp.
     *
     * @param integer $timestamp Timestamp of when the authorization was made
     * @return self
     */
    public function setAuthorizationTimestamp(int $timestamp): self
    {
        return $this->setAuthorizationTime(gmdate(DATE_ATOM, $timestamp));
    }
}
