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

    /**
     * @return void
     */
    public function __construct()
    {
        foreach (range(1, 20) as $i) {
            $roomid = new roomid((string)$i);

            $this->db[$roomid->getvalue()] = new room($roomid, new roomname('会議室 ' . $i));
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
     * 会議室の新規保存を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function insert(Room $room): void
    {
        $this->db[$room->getRoomId()->getValue()] = $room;

        dd($this->db);
    }

    /**
     * 会議室の更新を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function update(Room $room): void
    {
        $this->db[$room->getRoomId()->getValue()] = $room;

        dd($this->db);
    }

    /**
     * 会議室の削除を行う。
     *
     * @param RoomId $roomId
     *
     * @return void
     */
    public function delete(RoomId $roomId): void
    {
        unset($this->db[$roomId->getValue()]);

        dd($this->db);
    }
}
