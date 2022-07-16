<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\RegisterRequest;
use App\Http\Requests\Reservation\ShowRegisterRequest;
use packages\Domain\Domain\Reservation\Exception\PeriodicDuplicationException;
use packages\UseCase\Reservation\Register\ReservationRegisterRequest;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;

class RegisterReservationController extends Controller
{
    /**
     * 登録画面を表示する。
     *
     * @param ShowRegisterRequest $request
     */
    public function create(ShowRegisterRequest $request)
    {
        return view('rooms.reservations.register', ['room_id' => $request->validated('room_id')]);
    }

    /**
     * 予約の登録を実行する。
     *
     * @param RegisterRequest                     $request
     * @param ReservationRegisterUseCaseInterface $interactor
     */
    public function handle(RegisterRequest $request, ReservationRegisterUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        try {
            $response = $interactor->handle(
                new ReservationRegisterRequest(
                    $validated['room_id'],
                    $validated['summary'],
                    $validated['start_at'],
                    $validated['end_at'],
                    $validated['note'] ?? '' // noteはnullの可能性がある
                )
            );
            $url = '/rooms/show/' . $response->getReservation()->getRoomId()->getValue();

            return redirect($url)->with('message', '予約の登録が完了しました。');
        } catch (PeriodicDuplicationException $exception) {
            return redirect()
                ->route('reservations.register', ['room_id' => $validated['room_id']])
                ->with('exception', 'すでに予約が入っています。')
                ->withInput($request->all());
        }
    }
}
