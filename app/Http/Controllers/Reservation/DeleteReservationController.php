<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\DeleteRequest;
use packages\UseCase\Reservation\Delete\ReservationDeleteRequest;
use packages\UseCase\Reservation\Delete\ReservationDeleteUseCaseInterface;

class DeleteReservationController extends Controller
{
    public function handle(DeleteRequest $request, ReservationDeleteUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        $response = $interactor->handle(
            new ReservationDeleteRequest($validated['room_id'], $validated['reservation_id'])
        );

        return redirect()->route('detail', ['id' => $response->getRoomId()])->with('message', '予約を削除しました。');
    }
}
