<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Common;

class RoomModel
{
    /**
     * @var string $roomId
     */
    public string $roomId;

    /**
     * @var string $name
     */
    public string $name;

    /**
     * @param string $roomId
     * @param string $name
     *
     * @return void
     */
    public function __construct(string $roomId, string $name)
    {
        $this->roomId = $roomId;
        $this->name = $name;
    }
}
