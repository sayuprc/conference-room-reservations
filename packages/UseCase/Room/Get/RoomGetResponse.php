<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

use packages\Domain\Domain\Room\Room;

class RoomGetResponse
{
    /**
     * @var Room $room
     */
    public Room $room;

    /**
     * @param Room $room
     *
     * @return void
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }
}
