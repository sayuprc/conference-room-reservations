<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

class RoomGetRequest
{
    /**
     * @var string $roomId;
     */
    public string $roomId;

    /**
     * @param string $roomId
     *
     * @return void
     */
    public function __construct(string $roomId)
    {
        $this->roomId = $roomId;
    }
}
