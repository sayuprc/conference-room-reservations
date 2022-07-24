<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

class ReservationService
{
    /**
     * @var ReservationRepositoryInterface $repository
     */
    private ReservationRepositoryInterface $repository;

    /**
     * @param ReservationRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(ReservationRepositoryInterface $repository)
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
        $registeredReservations = $this->repository->findByRoomId($newReservation->getRoomId());

        $newStartAt = $newReservation->getStartAt()->getValue()->format('Y/m/d H:i');
        $newEndAt = $newReservation->getEndAt()->getValue()->format('Y/m/d H:i');

        $duplicatedReservations = array_filter(
            $registeredReservations,
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

    /**
     * 予約の更新が可能であるかの判定を行う。
     *
     * 予約の開始、終了が他の予約とかぶっている場合、予約できない。
     *
     * @param Reservation $reservation
     *
     * @return bool
     */
    public function canUpdated(Reservation $newReservation): bool
    {
        // $room = $this->repository->find($newReservation->getRoomId());

        // $targetReservationId = $newReservation->getReservationId();
        // $newStartAt = $newReservation->getStartAt()->getValue()->format('Y/m/d H:i');
        // $newEndAt = $newReservation->getEndAt()->getValue()->format('Y/m/d H:i');

        // $duplicatedReservations = array_filter(
        //     $room->getReservations(),
        //     function (Reservation $reservation) use ($targetReservationId, $newStartAt, $newEndAt): bool {
        //         // 同一の予約は判断の対象外
        //         if ($reservation->getReservationId()->equals($targetReservationId)) {
        //             return false;
        //         }

        //         $startAt = $reservation->getStartAt()->getValue()->format('Y/m/d H:i');
        //         $endAt = $reservation->getEndAt()->getValue()->format('Y/m/d H:i');

        //         if (
        //             ($startAt <= $newStartAt && $newStartAt <= $endAt)
        //             || ($startAt <= $newEndAt && $newEndAt <= $endAt)
        //             || ($newStartAt <= $startAt && $endAt <= $newEndAt)
        //         ) {
        //             return true;
        //         }

        //         return false;
        //     }
        // );

        // return count($duplicatedReservations) < 1 ? true : false;

        // TODO 後で実装する。
        return true;
    }
}
