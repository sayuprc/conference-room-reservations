<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use packages\Domain\Domain\Room\RoomId;

interface ReservationRepositoryInterface
{
    /**
     * 会議室IDと予約IDで予約を検索する。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @return Reservation
     */
    public function find(RoomId $roomId, ReservationId $reservationId): Reservation;

    /**
     * 会議室IDで予約を検索する。
     *
     * @param RoomId $roomId
     *
     * @return array<Reservation>
     */
    public function findByRoomId(RoomId $roomId): array;

    /**
     * 予約を新規登録する。
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function insert(Reservation $reservation): void;

    /**
     * 予約を更新する。
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function update(Reservation $reservation): void;

    /**
     * 予約を削除する。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @return void
     */
    public function delete(RoomId $roomId, ReservationId $reservationId): void;
}
