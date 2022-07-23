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

    /**
     * @return void
     */
    public function __construct()
    {
        foreach (range(1, 20) as $i) {
            $roomId = new RoomId((string)$i);

            $reservations = [];

            foreach (range(1, 30) as $j) {
                $reservationsId = new ReservationId((string)$j);
                $reservations[$reservationsId->getValue()] = new Reservation(
                    $roomId,
                    $reservationsId,
                    new Summary('概要 ' . $j),
                    new StartAt(new DateTime()),
                    new EndAt((new DateTime())->modify('+' . $j . ' hours')),
                    new Note('備考 ' . $j)
                );
            }

            $this->db[$roomId->getValue()] = new Room($roomId, new RoomName('会議室 ' . $i), $reservations);
        }
    }

    /**
     * 特定の会議室を取得する。
     *
     * @param RoomId $roomId
     *
     * @throws NotFoundException
     *
     * @return Room
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
     * すべての会議室を取得する。
     *
     * @return array<Room>
     */
    public function findAll(): array
    {
        return $this->db;
    }

    /**
     * 会議室の保存を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function store(Room $room): void
    {
        $storedRoom = $this->db[$room->getRoomId()->getValue()] ?? $room;

        $this->db[$storedRoom->getRoomId()->getValue()] = $room;
    }
}
