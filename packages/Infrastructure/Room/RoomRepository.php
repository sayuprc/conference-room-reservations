<?php

declare(strict_types=1);

namespace packages\Infrastructure\Room;

use App\Models\Room as EloquentRoom;
use Illuminate\Support\Str;
use packages\Domain\Domain\Reservation\ReservationSpecification;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\Domain\Domain\Room\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * @var ReservationSpecification $reservationSpecification
     */
    private ReservationSpecification $reservationSpecification;

    /**
     * @param ReservationSpecification $reservationSpecification
     *
     * @return void
     */
    public function __construct(ReservationSpecification $reservationSpecification)
    {
        $this->reservationSpecification = $reservationSpecification;
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
     * 会議室の保存を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function store(Room $room): void
    {
        $storedRoom = EloquentRoom::find($room->getRoomId()->getValue());

        if ($storedRoom === null) {
            $storedRoom = new EloquentRoom([
                'room_id' => (string)Str::uuid(),
                'name' => $room->getRoomName()->getValue(),
            ]);
        } else {
            $storedRoom->name = $room->getRoomName()->getValue();
        }

        $storedRoom->save();
    }
}
