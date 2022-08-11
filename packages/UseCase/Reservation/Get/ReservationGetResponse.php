<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Get;

use packages\UseCase\Reservation\Common\ReservationModel;

class ReservationGetResponse
{
    /**
     * @var ReservationModel $reservation
     */
    private ReservationModel $reservation;

    /**
     * @param ReservationModel $reservation
     *
     * @return void
     */
    public function __construct(ReservationModel $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * 予約を取得する。
     *
     * @return ReservationModel
     */
    public function getReservation(): ReservationModel
    {
        return $this->reservation;
    }
}
