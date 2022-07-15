<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Register;

use packages\Domain\Domain\Reservation\Reservation;

class ReservationRegisterResponse
{
    /**
     * @var Reservation $reservation
     */
    private Reservation $reservation;

    /**
     * @param Reservation $reservation
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * 登録した予約を取得する。
     *
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }
}
