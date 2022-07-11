<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use DateTimeInterface;

class StartAt
{
    /**
     * @var DateTimeInterface $value
     */
    private DateTimeInterface $value;

    /**
     * @param DateTimeInterface $value
     *
     * @return void
     */
    public function __construct(DateTimeInterface $value)
    {
        $this->value = $value;
    }

    /**
     * 開始日時を取得する。
     *
     * @return DateTimeInterface
     */
    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }
}
