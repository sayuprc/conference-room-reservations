<?php

declare(strict_types=1);

namespace packages\UseCase\Room\GetList;

use packages\Domain\Domain\Room\Room;

class RoomGetListResponse
{
    /**
     * @var array<Room> $rooms
     */
    public array $rooms;

    /**
     * @param array<Room> $rooms
     *
     * @return void
     */
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
    }
}
