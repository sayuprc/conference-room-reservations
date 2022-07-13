<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Register;

use packages\Domain\Domain\Reservation\Reservation;

class ReservationRegisterResponse
{
    private Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function getReservation(): Reservation
    {
        return $this->reservation;
    }
}
