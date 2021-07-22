<?php

namespace Serato\UserProfileSdk\Exception;

use RuntimeException;

/**
 * Represents an error in the body of a message received from a queue
 */
class InvalidMessageBodyException extends RuntimeException
{
}
