<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Room;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
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
            return new Room(
                new RoomId((string)$i),
                new RoomName('Room . ' . $i),
                array_map(function (int $j) use ($i): Reservation {
                    return new Reservation(
                        new RoomId((string)$i),
                        new ReservationId((string)$j),
                        new Summary('クライアント Aとの打ち合わせ'),
                        new StartAt(new DateTime()),
                        new EndAt((new DateTime())->modify('+' . $j . ' hours')),
                        new Note(str_repeat('b', 10))
                    );
                }, range(1, 30))
            );
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
