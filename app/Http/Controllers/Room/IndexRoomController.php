<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Room\GetList\RoomGetListViewModel;
use packages\UseCase\Room\Common\RoomModel;
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
            function (RoomModel $room): RoomGetListViewModel {
                return new RoomGetListViewModel($room->roomId, $room->name);
            },
            $response->rooms
        );

        return view('rooms.index', ['rooms' => $roomViewModels]);
    }
}
