<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\UpdateRequest;
use packages\Domain\Domain\Reservation\Exception\PeriodicDuplicationException;
use packages\UseCase\Reservation\Update\ReservationUpdateRequest;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class UpdateReservationController extends Controller
{
    /**
     * 予約の更新を行う
     *
     * @param UpdateRequest                     $request
     * @param ReservationUpdateUseCaseInterface $interactor
     */
    public function handle(UpdateRequest $request, ReservationUpdateUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        try {
            $response = $interactor->handle(new ReservationUpdateRequest(
                $validated['room_id'],
                $validated['reservation_id'],
                $validated['summary'],
                $validated['start_at'],
                $validated['end_at'],
                $validated['note'] ?? '' // noteはnullの可能性がある。
            ));

            $reseravtion = $response->getReservation();

            return redirect()
                ->route(
                    'reservations.detail',
                    [
                        'room_id' => $reseravtion->getRoomId()->getValue(),
                        'reservation_id' => $reseravtion->getReservationId()->getValue(),
                    ]
                )
                ->with('message', '予約の更新が完了しました。');
        } catch (PeriodicDuplicationException $exception) {
            return redirect()
                ->route('reservations.detail', [
                    'room_id' => $validated['room_id'],
                    'reservation_id' => $validated['reservation_id'],
                ])
                ->with('exception', 'すでに予約が入っています。')
                ->withInput($request->all());
        }
    }
}
