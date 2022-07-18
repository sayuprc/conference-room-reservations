<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Room\Get;

use App\Http\ViewModels\Reservation\Get\ReservationGetViewModelCollection;

class RoomGetViewModel
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
     * @var array<string, ReservationGetViewModelCollection> $reservations 予約の配列
     */
    public array $reservations;

    /**
     * @param string                                           $id
     * @param string                                           $name
     * @param array<string, ReservationGetViewModelCollection> $reservations
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
