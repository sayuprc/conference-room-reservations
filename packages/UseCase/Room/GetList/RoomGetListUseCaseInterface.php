<?php

declare(strict_types=1);

namespace packages\UseCase\Room\GetList;

interface RoomGetListUseCaseInterface
{
    /**
     * 会議室の一覧を取得する。
     *
     * @param RoomGetListRequest $request
     *
     * @return RoomGetListResponse
     */
    public function handle(RoomGetListRequest $request): RoomGetListResponse;
}
