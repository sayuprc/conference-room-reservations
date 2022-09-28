<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\DetailRequest;
use App\Http\ViewModels\Reservation\Get\ReservationGetViewModel;
use App\Http\ViewModels\Room\Common\RoomViewModel;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;
use packages\UseCase\Room\Common\RoomModel;

class DetailReservationController extends Controller
{
    /**
     * 予約の詳細を表示する。
     *
     * @param DetailRequest                  $request
     * @param ReservationGetUseCaseInterface $interactor
     */
    public function handle(DetailRequest $request, ReservationGetUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        try {
            $response = $interactor->handle(new ReservationGetRequest($validated['reservation_id']));

            $reservation = $response->getReservation();

            $viewModel = new ReservationGetViewModel(
                $reservation->roomId,
                $reservation->reservationId,
                $reservation->summary,
                $reservation->startAt,
                $reservation->endAt,
                $reservation->note
            );

            $roomViewModels = array_map(
                function (RoomModel $room): RoomViewModel {
                    return new RoomViewModel($room->roomId, $room->name, []);
                },
                $response->getRooms()
            );

            return view('reservations.detail', ['reservation' => $viewModel, 'rooms' => $roomViewModels]);
        } catch (NotFoundException $exception) {
            return redirect()
                ->route('index')
                ->with('exception', '予約が存在しませんでした。');
        }
    }
}
