<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Room;

use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\Domain\Domain\Room\RoomRepositoryInterface;

class InMemoryRoomRepository implements RoomRepositoryInterface
{
    /**
     * @var array<Room> $db
     */
    private array $db;

    public function __construct()
    {
        $this->db = array_map(function (int $i) {
            return new Room(new RoomId((string)$i), new RoomName('Room . ' . $i));
        }, range(1, 10));
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        return $this->db;
    }
}
