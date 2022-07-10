<?php

declare(strict_types=1);

namespace packages\Infrastructure\Room;

use App\Models\Room as EloquentRoom;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\Domain\Domain\Room\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $collections = EloquentRoom::all()->map(
            function (EloquentRoom $room): Room {
                return new Room(new RoomId($room->room_id), new RoomName($room->name));
            }
        );

        return array_map(fn (Room $room) => $room, $collections->toArray());
    }
}
