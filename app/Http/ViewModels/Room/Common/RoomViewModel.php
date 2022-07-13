<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Room\Common;

use App\Http\ViewModels\Reservation\Get\ReservationGetViewModel;

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
     * @var array<ReservationGetViewModel> $reservations 予約の配列
     */
    public array $reservations;

    /**
     * @param string                         $id
     * @param string                         $name
     * @param array<ReservationGetViewModel> $reservations
     *
     * @return void
     */
    public function __construct(string $id, string $name, array $reservations)
    {
        $this->id = $id;
        $this->name = $name;
        $this->reservations = $reservations;
    }
}
