<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

use InvalidArgumentException;

class RoomId
{
    /**
     * @var string $value 会議室ID(UUID v4)
     */
    private string $value;

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('value: ' . $value . ' is invalid value.');
        }

        $this->value = $value;
    }

    /**
     * 会議室IDを取得する。
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
