<?php

declare(strict_types=1);

namespace packages\MockInteractor\Room;

use packages\UseCase\Room\Register\RoomRegisterRequest;
use packages\UseCase\Room\Register\RoomRegisterResponse;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class MockRoomRegisterInteractor implements RoomRegisterUseCaseInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 会議室の登録をする。
     *
     * @param RoomRegisterRequest $request
     *
     * @return RoomRegisterResponse
     */
    public function handle(RoomRegisterRequest $request): RoomRegisterResponse
    {
        return new RoomRegisterResponse();
    }
}
