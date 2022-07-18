<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;

class Room
{
    /**
     * @var RoomId $roomId
     */
    private RoomId $roomId;

    /**
     * @var RoomName $roomName
     */
    private RoomName $roomName;

    /**
     * @var array<Reservation> $reservations
     */
    private array $reservations;

    /**
     * @param RoomId             $roomId
     * @param RoomName           $roomName
     * @param array<Reservation> $reservations
     *
     * @return void
     */
    public function __construct(RoomId $roomId, RoomName $roomName, array $reservations = [])
    {
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->reservations = $reservations;
    }

    /**
     * 会議室IDのValueObjectを取得する。
     *
     * @return RoomId
     */
    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    /**
     * 会議室名のValueObjectを取得する。
     *
     * @return RoomName
     */
    public function getRoomName(): RoomName
    {
        return $this->roomName;
    }

    /**
     * 予約のValueObjectの配列を取得する。
     *
     * @return array<Reservation>
     */
    public function getReservations(): array
    {
        return $this->reservations;
    }

    /**
     * 会議室に予約を追加する。
     *
     * @param Reservation $reservation
     *
     * @return Room
     */
    public function addReservation(Reservation $reservation): Room
    {
        return new Room(
            $this->roomId,
            $this->roomName,
            [...$this->reservations, $reservation]
        );
    }

    /**
     * 会議室から予約を削除する。
     *
     * @param ReservationId $reservationId
     *
     * @return Room
     */
    public function removeReservation(ReservationId $reservationId): Room
    {
        return new Room(
            $this->roomId,
            $this->roomName,
            // 配列のインデックスを振りなおす
            [...array_filter(
                $this->reservations,
                function (Reservation $reservation) use ($reservationId): bool {
                    // 対象を取り除く
                    return ! $reservation->getReservationId()->equals($reservationId);
                }
            )]
        );
    }
}
