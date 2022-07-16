<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use packages\Domain\Domain\Room\RoomRepositoryInterface;

class ReservationService
{
    /**
     * @var RoomRepositoryInterface $repository
     */
    private RoomRepositoryInterface $repository;

    /**
     * @param RoomRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 予約の登録が可能であるかの判定を行う。
     *
     * 予約の開始、終了が他の予約とかぶっている場合、予約できない。
     *
     * @param Reservation $reservation
     *
     * @return bool
     */
    public function canRegistered(Reservation $newReservation): bool
    {
        $room = $this->repository->find($newReservation->getRoomId());

        $newStartAt = $newReservation->getStartAt()->getValue()->format('Y/m/d H:i');
        $newEndAt = $newReservation->getEndAt()->getValue()->format('Y/m/d H:i');

        $duplicatedReservations = array_filter(
            $room->getReservations(),
            function (Reservation $reservation) use ($newStartAt, $newEndAt): bool {
                $startAt = $reservation->getStartAt()->getValue()->format('Y/m/d H:i');
                $endAt = $reservation->getEndAt()->getValue()->format('Y/m/d H:i');

                if (
                    ($startAt <= $newStartAt && $newStartAt <= $endAt)
                    || ($startAt <= $newEndAt && $newEndAt <= $endAt)
                    || ($newStartAt <= $startAt && $endAt <= $newEndAt)
                ) {
                    return true;
                }

                return false;
            }
        );

        return count($duplicatedReservations) < 1 ? true : false;
    }
}
