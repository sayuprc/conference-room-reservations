<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Update;

use packages\UseCase\Reservation\Common\ReservationModel;

class ReservationUpdateResponse
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
     * 登録した予約を取得する。
     *
     * @return ReservationModel
     */
    public function getReservation(): ReservationModel
    {
        return $this->reservation;
    }
}
