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

    /**
     * 予約の配列を並び替える。
     * 開始日の昇順で並び替える。
     *
     * **パフォーマンスが悪いと感じた場合、このクラスは利用せずに、リポジトリでソートする**
     *
     * @param array<Reservation> $reservations
     *
     * @return array<Reservation>
     */
    public function orderByStartAtAsc(array $reservations): array
    {
        usort($reservations, function (Reservation $a, Reservation $b): int {
            return $a->getStartAt()->getValue()->format('Y/m/d H:i') <=> $b->getStartAt()->getValue()->format('Y/m/d H:i');
        });

        return $reservations;
    }
}
