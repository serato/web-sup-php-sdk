<?php

namespace Serato\UserProfileSdk\Exception;

use RuntimeException;

class InvalidUserGroupMessageException extends RuntimeException
{
    protected $message = "Invalid UserGroup";
}
