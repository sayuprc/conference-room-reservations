<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\DetailRequest;
use App\Http\ViewModels\Reservation\Common\ReservationViewModel;
use App\Http\ViewModels\Reservation\GetList\ReservationGetListViewModel;
use App\Http\ViewModels\Room\Get\RoomGetViewModel;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\Reservation\Common\ReservationModel;
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
        try {
            $response = $interactor->handle(new RoomGetRequest($request->validated('id')));

            $reservationViewModels = array_map(
                function (ReservationModel $reservation): ReservationViewModel {
                    return new ReservationViewModel(
                        $reservation->roomId,
                        $reservation->reservationId,
                        $reservation->summary,
                        $reservation->startAt,
                        $reservation->endAt,
                        $reservation->note
                    );
                },
                $response->reservations
            );

            $reservationCollection = [];

            $dayOfWeek = ['日', '月', '火', '水', '木', '金', '土'];

            foreach ($reservationViewModels as $viweModel) {
                $startAt = sprintf(
                    '%s (%s)',
                    $viweModel->startAt->format('Y/m/d'),
                    $dayOfWeek[(int)$viweModel->startAt->format('w')]
                );

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
                $response->room->roomId,
                $response->room->name,
                $reservationCollection
            );

            return view('rooms.detail', ['room' => $roomViewModel]);
        } catch (NotFoundException $exception) {
            return redirect()->route('index')->with('exception', '会議室が存在しません。');
        }
    }
}
