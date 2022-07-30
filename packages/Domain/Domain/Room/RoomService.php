<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

use packages\Domain\Domain\Room\Exception\NotFoundException;

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
        try {
            $found = $this->repository->find($roomId);

            return true;
        } catch (NotFoundException $exception) {
            return false;
        }
    }
}
