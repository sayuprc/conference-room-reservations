<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\DetailRequest;
use App\Http\ViewModels\Room\Common\RoomViewModel;
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

        $roomViewModel = new RoomViewModel(
            $response->room->getRoomId()->getValue(),
            $response->room->getRoomName()->getValue()
        );

        return view('rooms.detail', ['room' => $roomViewModel]);
    }
}
