<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;

class MockReservationRegisterInteractor implements ReservationRegisterUseCaseInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
    }
}
