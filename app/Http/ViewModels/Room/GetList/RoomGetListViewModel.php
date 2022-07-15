<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Room\GetList;

class RoomGetListViewModel
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
     * @var string $detailUrl 詳細画面へのURL
     */
    public string $detailUrl;

    /**
     * @param string $id   会議室ID
     * @param string $name 会議室名
     *
     * @return void
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;

        $this->detailUrl = sprintf('/rooms/show/%s', $this->id);
    }
}
