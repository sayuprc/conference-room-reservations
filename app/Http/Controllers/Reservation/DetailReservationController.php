<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\DetailRequest;
use App\Http\ViewModels\Reservation\Get\ReservationGetViewModel;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;

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
            $response = $interactor->handle(
                new ReservationGetRequest($validated['room_id'], $validated['reservation_id'])
            );

            $reservation = $response->getReservation();

            $viewModel = new ReservationGetViewModel(
                $reservation->getRoomId()->getValue(),
                $reservation->getReservationId()->getValue(),
                $reservation->getSummary()->getValue(),
                $reservation->getStartAt()->getValue(),
                $reservation->getEndAt()->getValue(),
                $reservation->getNote()->getValue()
            );

            return view('rooms.reservations.detail', ['reservation' => $viewModel]);
        } catch (NotFoundException $exception) {
            return redirect()
                ->route('detail', ['id' => $validated['room_id']])
                ->with('exception', '予約が存在しませんでした。');
        }
    }
}
