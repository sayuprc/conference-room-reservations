<?php

declare(strict_types=1);

namespace packages\MockInteractor\Room;

use packages\UseCase\Room\Register\RoomRegisterRequest;
use packages\UseCase\Room\Register\RoomRegisterResponse;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class MockRoomRegisterInteractor implements RoomRegisterUseCaseInterface
{
    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function handle(RoomRegisterRequest $request): RoomRegisterResponse
    {
        return new RoomRegisterResponse();
    }
}
