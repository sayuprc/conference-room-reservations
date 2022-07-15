<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use DateTime;

class ReservationSpecification
{
    /**
     * 開始前の予約に絞り込む
     *
     * @param array<Reservation> $reservations
     *
     * @return array<Reservation>
     */
    public function getBeforeStartedReservations(array $reservations): array
    {
        $today = (new DateTime())->format('Y/m/d');

        return array_filter($reservations, function (Reservation $reservation) use ($today): bool {
            return $today <= $reservation->getStartAt()->getValue()->format('Y/m/d') ? true : false;
        });
    }
}
