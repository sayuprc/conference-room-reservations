<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Room\Common\RoomModel;

class RoomGetResponse
{
    /**
     * @var RoomModel $room
     */
    public RoomModel $room;

    /**
     * @var array<ReservationModel> $reservations
     */
    public array $reservations;

    /**
     * @param RoomModel               $room
     * @param array<ReservationModel> $reservations
     *
     * @return void
     */
    public function __construct(RoomModel $room, array $reservations = [])
    {
        $this->room = $room;
        $this->reservations = $reservations;
    }
}
