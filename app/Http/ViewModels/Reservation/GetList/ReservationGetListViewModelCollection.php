<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Reservation\GetList;

class ReservationGetListViewModelCollection
{
    /**
     * @var array<string, ReservationGetListViewModel> $reservations
     */
    public array $reservations;

    /**
     * @param array<string, ReservationGetListViewModel> $reservations
     *
     * @return void
     */
    public function __construct(array $reservations)
    {
        $this->reservations = $reservations;
    }
}
