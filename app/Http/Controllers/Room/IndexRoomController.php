<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Room\Common\RoomViewModel;
use packages\Domain\Domain\Room\Room;
use packages\UseCase\Room\GetList\RoomGetListRequest;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;

class IndexRoomController extends Controller
{
    public function handle(RoomGetListUseCaseInterface $interactor)
    {
        $response = $interactor->handle(new RoomGetListRequest());

        $roomViewModels = array_map(
            function (Room $room) {
                return new RoomViewModel($room->getRoomId()->getValue(), $room->getRoomName()->getValue());
            },
            $response->rooms
        );

        return view('rooms.index', ['rooms' => $roomViewModels]);
    }
}
