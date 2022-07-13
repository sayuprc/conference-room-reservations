<?php

declare(strict_types=1);

namespace packages\Domain\Application\Room;

use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Room\Get\RoomGetRequest;
use packages\UseCase\Room\Get\RoomGetResponse;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;

class RoomGetInteractor implements RoomGetUseCaseInterface
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

    public function handle(RoomGetRequest $request): RoomGetResponse
    {
        $roomId = new RoomId($request->roomId);

        $found = $this->repository->find($roomId);

        return new RoomGetResponse($found);
    }
}
