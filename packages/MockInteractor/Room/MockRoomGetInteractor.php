<?php

declare(strict_types=1);

namespace packages\MockInteractor\Room;

use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Room\Get\RoomGetRequest;
use packages\UseCase\Room\Get\RoomGetResponse;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;

class MockRoomGetInteractor implements RoomGetUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $repository
     */
    private RoomRepositoryInterface $repository;

    /**
     * @param RoomRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 特定の会議室を取得する。
     *
     * @param RoomGetRequest $request
     *
     * @return RoomGetResponse
     */
    public function handle(RoomGetRequest $request): RoomGetResponse
    {
        $roomId = new RoomId($request->roomId);

        $found = $this->repository->find($roomId);

        return new RoomGetResponse($found);
    }
}
