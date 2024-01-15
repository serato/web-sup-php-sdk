<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Queue;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A POC concreate implementation of AbstractMessage
 */
class TestMessage extends AbstractMessage
{
    public static function create(int $userId, array $params = []): self
    {
        return new static($userId, $params);
    }

    public function setScalarValue($val): self
    {
        $this->setParam('scalarValue', $val);
        return $this;
    }

    public function setArrayValue(array $val): self
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
