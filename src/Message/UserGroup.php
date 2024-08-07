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
    public const GROUPS = 'groups';
    public const ID = 'id';
    public const NAME = 'name';

    /**
     * Creates a new message instance
     *
     * @param int   $userId      User ID
     * @param Array<mixed,mixed> $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    /**
     * Set groups that user belongs to
     *
     * @param array<int, mixed>  $groups   array of groups ['id' => $id, 'name' => $name]
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
     * @return null | array<string, mixed>
     */
    public function getGroups(): ?array
    {
        return $this->getParam(self::GROUPS);
    }
}
