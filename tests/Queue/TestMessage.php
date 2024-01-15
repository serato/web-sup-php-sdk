<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Queue;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A POC concreate implementation of AbstractMessage
 */
class TestMessage extends AbstractMessage
{
    /**
     * @param int $userId
     * @param array<string, int|string> $params
     */
    public static function create(int $userId, array $params = []): self
    {
        /** @phpstan-ignore-next-line */
        return new static($userId, $params);
    }

    public function setScalarValue(string $val): self
    {
        $this->setParam('scalarValue', $val);
        return $this;
    }

    /**
     * @param array<string, int|string> $val
     */
    public function setArrayValue($val): self
    {
        $this->setParam('arrayValue', $val);
        return $this;
    }

    /**
     * @return null | mixed
     */
    public function getScalarValue()
    {
        return $this->getParam('scalarValue');
    }

    /**
     * @return null | mixed
     */
    public function getArrayValue()
    {
        return $this->getParam('arrayValue');
    }
}
