<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

class RoomService
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
     * 会議室が存在するかのチェックを行う。
     *
     * @param RoomId $roomId
     *
     * @return bool
     */
    public function exists(RoomId $roomId): bool
    {
        return $this->repository->find($roomId) === null ? false : true;
    }
}
