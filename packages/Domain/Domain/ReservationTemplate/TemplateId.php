<?php

declare(strict_types=1);

namespace packages\Domain\Domain\ReservationTemplate;

use InvalidArgumentException;

class TemplateId
{
    /**
     * @var int $value
     */
    private int $value;

    /**
     * @param int $value
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(int $value)
    {
        if ($value < 1) {
            throw new InvalidArgumentException($value . ' is invalid.');
        }

        $this->value = $value;
    }

    /**
     * 予約テンプレートIDを取得する。
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
