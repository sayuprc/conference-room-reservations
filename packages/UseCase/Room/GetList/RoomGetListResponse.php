<?php

declare(strict_types=1);

namespace packages\UseCase\Room\GetList;

use packages\UseCase\Room\Common\RoomModel;

class RoomGetListResponse
{
    /**
     * @var array<RoomModel> $rooms
     */
    public array $rooms;

    /**
     * @param array<RoomModel> $rooms
     *
     * @return void
     */
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
    }
}
