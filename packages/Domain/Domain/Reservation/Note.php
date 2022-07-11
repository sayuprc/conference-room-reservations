<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use InvalidArgumentException;

class Note
{
    /**
     * 会議備考の最大文字列長。
     */
    const MAX_LENGTH = 1024;

    /**
     * @var string $value
     */
    private string $value;

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(string $value = '')
    {
        if (self::MAX_LENGTH < mb_strlen($value)) {
            throw new InvalidArgumentException('value: ' . $value . ' is invalid value.');
        }

        $this->value = $value;
    }

    /**
     * 会議備考を取得する。
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
