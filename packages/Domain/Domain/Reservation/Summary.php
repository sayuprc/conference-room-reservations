<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use InvalidArgumentException;

class Summary
{
    /**
     * 会議概要の最大文字列長。
     */
    const MAX_LENGTH = 256;

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
    public function __construct(string $value)
    {
        if (empty($value) || self::MAX_LENGTH < mb_strlen($value)) {
            throw new InvalidArgumentException('value: ' . $value . ' is invalid value.');
        }

        $this->value = $value;
    }

    /**
     * 会議概要を取得する。
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
