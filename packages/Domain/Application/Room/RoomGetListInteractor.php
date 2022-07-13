<?php

declare(strict_types=1);

namespace packages\Domain\Application\Room;

use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Room\GetList\RoomGetListRequest;
use packages\UseCase\Room\GetList\RoomGetListResponse;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;

class RoomGetListInteractor implements RoomGetListUseCaseInterface
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
     * @inheritdoc
     */
    public function handle(RoomGetListRequest $request): RoomGetListResponse
    {
        return new RoomGetListResponse($this->repository->findAll());
    }
}
