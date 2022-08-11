<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\RoomId;

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

                return $this->isDuplicated($newStartAt, $newEndAt, $startAt, $endAt);
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
        $registeredReservations = $this->repository->findByRoomId($newReservation->getRoomId());

        $targetReservationId = $newReservation->getReservationId();
        $newStartAt = $newReservation->getStartAt()->getValue()->format('Y/m/d H:i');
        $newEndAt = $newReservation->getEndAt()->getValue()->format('Y/m/d H:i');

        $duplicatedReservations = array_filter(
            $registeredReservations,
            function (Reservation $reservation) use ($targetReservationId, $newStartAt, $newEndAt): bool {
                // 同一の予約は判断の対象外
                if ($reservation->getReservationId()->equals($targetReservationId)) {
                    return false;
                }

                $startAt = $reservation->getStartAt()->getValue()->format('Y/m/d H:i');
                $endAt = $reservation->getEndAt()->getValue()->format('Y/m/d H:i');

                return $this->isDuplicated($newStartAt, $newEndAt, $startAt, $endAt);
            }
        );

        return count($duplicatedReservations) < 1 ? true : false;
    }

    /**
     * 日付が重複しているかチェックする。
     *
     * @param string $newStartAt
     * @param string $newEndAt
     * @param string $startAt
     * @param string $endAt
     *
     * @return bool
     */
    private function isDuplicated(string $newStartAt, string $newEndAt, string $startAt, string $endAt): bool
    {
        if (
            ($startAt <= $newStartAt && $newStartAt < $endAt)
            || ($startAt <= $newEndAt && $newEndAt <= $endAt)
            || ($newStartAt <= $startAt && $endAt <= $newEndAt)
        ) {
            return true;
        }

        return false;
    }

    /**
     * 予約がが存在するかのチェックを行う。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @return bool
     */
    public function exists(RoomId $roomId, ReservationId $reservationId): bool
    {
        try {
            $found = $this->repository->find($roomId, $reservationId);

            return true;
        } catch (NotFoundException $exception) {
            return false;
        }
    }
}
