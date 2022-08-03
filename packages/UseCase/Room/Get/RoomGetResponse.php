<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

use packages\Domain\Domain\Reservation\Reservation;
use packages\UseCase\Room\Common\RoomModel;

class RoomGetResponse
{
    /**
     * @var RoomModel $room
     */
    public RoomModel $room;

    /**
     * @var array<Reservation> $reservations
     */
    public array $reservations;

    /**
     * @param RoomModel          $room
     * @param array<Reservation> $reservations
     *
     * @return void
     */
    public function __construct(RoomModel $room, array $reservations = [])
    {
        $this->room = $room;
        $this->reservations = $reservations;
    }
}
