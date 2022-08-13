<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Get;

class ReservationGetRequest
{
    /**
     * @var string $reservationId
     */
    private string $reservationId;

    /**
     * @param string $reservationId
     *
     * @return void
     */
    public function __construct(string $reservationId)
    {
        $this->reservationId = $reservationId;
    }

    /**
     * 予約IDを取得する。
     *
     * @return string
     */
    public function getReservationId(): string
    {
        return $this->reservationId;
    }
}
