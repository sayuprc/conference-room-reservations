<?php

declare(strict_types=1);

namespace packages\Domain\Application\Room;

use Illuminate\Support\Str;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Room\Register\RoomRegisterRequest;
use packages\UseCase\Room\Register\RoomRegisterResponse;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class RoomRegisterInteractor implements RoomRegisterUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $reposiroty
     */
    private RoomRepositoryInterface $reposiroty;

    /**
     * @param RoomRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->reposiroty = $repository;
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
        $newRoom = new Room(new RoomId((string)Str::uuid()), new RoomName($request->name));

        $this->reposiroty->insert($newRoom);

        return new RoomRegisterResponse();
    }
}
