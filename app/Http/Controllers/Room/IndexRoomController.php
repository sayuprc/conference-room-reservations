<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Room\GetList\RoomGetListViewModel;
use packages\Domain\Domain\Room\Room;
use packages\UseCase\Room\GetList\RoomGetListRequest;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;

class IndexRoomController extends Controller
{
    /**
     * 会議室の一覧を表示する。
     *
     * @param RoomGetListUseCaseInterface $interactor
     */
    public function handle(RoomGetListUseCaseInterface $interactor)
    {
        $response = $interactor->handle(new RoomGetListRequest());

        $roomViewModels = array_map(
            function (Room $room) {
                return new RoomGetListViewModel($room->getRoomId()->getValue(), $room->getRoomName()->getValue());
            },
            $response->rooms
        );

        return view('rooms.index', ['rooms' => $roomViewModels]);
    }
}
