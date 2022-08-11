<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Get;

use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Room\Common\RoomModel;

class ReservationGetResponse
{
    /**
     * @var ReservationModel $reservation
     */
    private ReservationModel $reservation;

    /**
     * @var array<RoomModel> $rooms;
     */
    private array $rooms;

    /**
     * @param ReservationModel $reservation
     * @param array<RoomModel> $rooms;
     *
     * @return void
     */
    public function __construct(ReservationModel $reservation, array $rooms)
    {
        $this->reservation = $reservation;
        $this->rooms = $rooms;
    }

    /**
     * 予約を取得する。
     *
     * @return ReservationModel
     */
    public function getReservation(): ReservationModel
    {
        return $this->reservation;
    }

    /**
     * 会議室一覧を取得する。
     *
     * @return array<RoomModel>
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }
}
