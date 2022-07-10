<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Register;

interface RoomRegisterUseCaseInterface
{
    /**
     * 会議室の登録をする。
     *
     * @param RoomRegisterRequest $request)
     *
     * @return RoomRegisterResponse
     */
    public function handle(RoomRegisterRequest $request): RoomRegisterResponse;
}
