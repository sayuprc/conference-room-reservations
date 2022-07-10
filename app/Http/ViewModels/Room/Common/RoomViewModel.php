<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Room\Common;

class RoomViewModel
{
    /**
     * @var string $id 会議室ID
     */
    public string $id;

    /**
     * @var string $name 会議室名
     */
    public string $name;

    /**
     * @return void
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
