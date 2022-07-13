<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Room;

use packages\Domain\Domain\Room\Exception\NotFoundException;
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
        }, range(1, 20));
    }

    /**
     * @inheritdoc
     *
     * @throws NotFoundException
     */
    public function find(RoomId $roomId): Room
    {
        foreach ($this->db as $room) {
            if ($room->getRoomId()->getValue() === $roomId->getValue()) {
                return $room;
            }
        }

        throw new NotFoundException('ID: ' . $roomId->getValue() . ' is not found.');
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        return $this->db;
    }

    /**
     * @inheritdoc
     */
    public function store(Room $room): void
    {
    }
}
