<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Room\Room;

class RoomGetResponse
{
    /**
     * @var Room $room
     */
    public Room $room;

    /**
     * @var array<Reservation> $reservations
     */
    public array $reservations;

    /**
     * @param Room               $room
     * @param array<Reservation> $reservations
     *
     * @return void
     */
    public function __construct(Room $room, array $reservations = [])
    {
        $this->room = $room;
        $this->reservations = $reservations;
    }
}
