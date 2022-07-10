<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Register;

class RoomRegisterRequest
{
    /**
     * @var string $name
     */
    public string $name;

    /**
     * @param string $name
     *
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
