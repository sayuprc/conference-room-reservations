<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

use InvalidArgumentException;

class RoomName
{
    /**
     * 会議室名の最大文字長。
     */
    private const MAX_LENGTH = 64;

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
        if (empty($value) || self::MAX_LENGTH < mb_strlen($value)) {
            throw new InvalidArgumentException('value: ' . $value . ' is invalid value.');
        }

        $this->value = $value;
    }

    /**
     * 会議室名を取得する。
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
