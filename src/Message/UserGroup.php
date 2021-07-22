<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;
use Serato\UserProfileSdk\Exception\InvalidUserGroupMessageException;

/**
 * A message representing groups that the user is member of
 */
class UserGroup extends AbstractMessage
{
    const GROUPS = 'groups';
    const ID = 'id';
    const NAME = 'name';

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
     * Set groups that user belongs to
     *
     * @param array    $groups   array of groups ['id' => $id, 'name' => $name]
     * @return self
     */
    public function setGroups(array $groups): self
    {
        foreach ($groups as $group) {
            if (
                !is_array($group) ||
                count(array_keys($group)) !== 2 ||
                !isset($group[self::ID]) ||
                !isset($group[self::NAME]) ||
                !is_numeric($group[self::ID]) ||
                !is_string($group[self::NAME])
            ) {
                throw new InvalidUserGroupMessageException();
            }
        }
        $this->setParam(self::GROUPS, $groups);
        return $this;
    }

    /**
     * Get array of groups
     *
     * @return null | array
     */
    public function getGroups(): ?array
    {
        return $this->getParam(self::GROUPS);
    }
}
