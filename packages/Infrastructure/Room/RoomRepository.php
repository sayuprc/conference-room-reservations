<?php

declare(strict_types=1);

namespace packages\Infrastructure\Room;

use App\Models\Room as EloquentRoom;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\Domain\Domain\Room\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
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
        $storedRoom = EloquentRoom::with('reservations')->find($roomId->getValue());

        if ($storedRoom === null) {
            throw new NotFoundException('ID: ' . $roomId->getValue() . ' is not found.');
        }

        $storedRoomId = new RoomId($storedRoom->room_id);

        return new Room($storedRoomId, new RoomName($storedRoom->name));
    }

    /**
     * すべての会議室を取得する。
     *
     * @return array<Room>
     */
    public function findAll(): array
    {
        $collections = EloquentRoom::all()->map(
            function (EloquentRoom $room): Room {
                return new Room(new RoomId($room->room_id), new RoomName($room->name));
            }
        );

        return array_map(fn (Room $room): Room => $room, $collections->toArray());
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
        $newRoom = new EloquentRoom([
            'room_id' => $room->getRoomId()->getValue(),
            'name' => $room->getRoomName()->getValue(),
        ]);

        $newRoom->save();
    }

    /**
     * 会議室の更新を行う。
     *
     * @param Room $room
     *
     * @throws NotFoundException
     *
     * @return void
     */
    public function update(Room $room): void
    {
        $storedRoom = EloquentRoom::find($room->getRoomId()->getValue());

        if ($storedRoom === null) {
            throw new NotFoundException('ID: ' . $room->getRoomId()->getValue() . ' is not found.');
        }

        $storedRoom->name = $room->getRoomName()->getValue();
        $storedRoom->save();
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
        // TODO 後で実装する。
    }
}
