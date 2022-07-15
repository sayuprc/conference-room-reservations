<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use DateTime;

class ReservationSpecification
{
    /**
     * すでに終了しているの予約を取り除く。
     *
     * **パフォーマンスが悪いと感じた場合、このクラスは利用せずに、リポジトリでフィルターする**
     *
     * @param array<Reservation> $reservations
     *
     * @return array<Reservation>
     */
    public function removeFinished(array $reservations): array
    {
        $today = (new DateTime())->format('Y/m/d');

        return array_filter($reservations, function (Reservation $reservation) use ($today): bool {
            return $reservation->getEndAt()->getValue()->format('Y/m/d') < $today ? false : true;
        });
    }
}
