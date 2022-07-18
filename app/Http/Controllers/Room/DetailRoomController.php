<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\DetailRequest;
use App\Http\ViewModels\Reservation\Common\ReservationViewModel;
use App\Http\ViewModels\Reservation\GetList\ReservationGetListViewModel;
use App\Http\ViewModels\Room\Get\RoomGetViewModel;
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

        /**
         * @var array<ReservationViewModel> $reservationViewModels
         */
        $reservationViewModels = array_map(
            function (Reservation $reservation): ReservationViewModel {
                return new ReservationViewModel(
                    $reservation->getRoomId()->getValue(),
                    $reservation->getReservationId()->getValue(),
                    $reservation->getSummary()->getValue(),
                    $reservation->getStartAt()->getValue(),
                    $reservation->getEndAt()->getValue(),
                    $reservation->getNote()->getValue()
                );
            },
            $response->room->getReservations()
        );

        $reservationCollection = [];

        foreach ($reservationViewModels as $viweModel) {
            $startAt = $viweModel->startAt->format('Y/m/d');
            $reservationCollection[$startAt][] = new ReservationGetListViewModel(
                $viweModel->roomId,
                $viweModel->reservationId,
                $viweModel->summary,
                $viweModel->startAt,
                $viweModel->endAt,
                $viweModel->note
            );
        }

        $roomViewModel = new RoomGetViewModel(
            $response->room->getRoomId()->getValue(),
            $response->room->getRoomName()->getValue(),
            $reservationCollection
        );

        return view('rooms.detail', ['room' => $roomViewModel]);
    }
}
