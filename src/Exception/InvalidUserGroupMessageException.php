<?php

namespace Serato\UserProfileSdk\Exception;

use RuntimeException;

class InvalidUserGroupMessageException extends RuntimeException
{
    /**
     * @var string
     */
    protected $message = "Invalid UserGroup";
}
