<?php

declare(strict_types=1);

namespace packages\UseCase\Room\Get;

interface RoomGetUseCaseInterface
{
    /**
     * 特定の会議室を取得する。
     *
     * @param RoomGetRequest $request
     *
     * @return RoomGetResponse
     */
    public function handle(RoomGetRequest $request): RoomGetResponse;
}
