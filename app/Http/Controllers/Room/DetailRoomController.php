<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\DetailRequest;
use App\Http\ViewModels\Reservation\Get\ReservationGetViewModel;
use App\Http\ViewModels\Room\Common\RoomViewModel;
use packages\Domain\Domain\Reservation\Reservation;
use packages\UseCase\Room\Get\RoomGetRequest;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;

class DetailRoomController extends Controller
{
    /**
     * 会議室の詳細を表示する。
     *
     * @param DetailRequest           $request
     * @param RoomGetUseCaseInterface $interactor
     */
    public function handle(DetailRequest $request, RoomGetUseCaseInterface $interactor)
    {
        $response = $interactor->handle(new RoomGetRequest($request->validated('id')));

        $roomViewModel = new RoomViewModel(
            $response->room->getRoomId()->getValue(),
            $response->room->getRoomName()->getValue(),
            array_map(
                function (Reservation $reservation): ReservationGetViewModel {
                    return new ReservationGetViewModel(
                        $reservation->getRoomId()->getValue(),
                        $reservation->getReservationId()->getValue(),
                        $reservation->getSummary()->getValue(),
                        $reservation->getStartAt()->getValue(),
                        $reservation->getEndAt()->getValue(),
                        $reservation->getNote()->getValue()
                    );
                },
                $response->room->getReservations()
            )
        );

        return view('rooms.detail', ['room' => $roomViewModel]);
    }
}
