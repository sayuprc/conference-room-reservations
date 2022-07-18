<?php

declare(strict_types=1);

namespace packages\Infrastructure\Room;

use App\Models\Reservation as EloquentReservation;
use App\Models\Room as EloquentRoom;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationSpecification;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
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
     * @inheritdoc
     *
     * @throws NotFoundException
     */
    public function find(RoomId $roomId): Room
    {
        $storedRoom = EloquentRoom::with('reservations')->find($roomId->getValue());

        if ($storedRoom === null) {
            throw new NotFoundException('ID: ' . $roomId->getValue() . ' is not found.');
        }

        $storedRoomId = new RoomId($storedRoom->room_id);

        return new Room(
            $storedRoomId,
            new RoomName($storedRoom->name),
            $this->reservationSpecification->orderByStartAtAsc(
                $this->reservationSpecification->removeFinished(
                    array_map(
                    fn (Reservation $r): Reservation => $r,
                    $storedRoom->reservations()->get()->map(
                        function (EloquentReservation $reservation) use ($storedRoomId): Reservation {
                            return new Reservation(
                                $storedRoomId,
                                new ReservationId($reservation->reservation_id),
                                new Summary($reservation->summary),
                                new StartAt(new DateTime($reservation->start_at)),
                                new EndAt(new DateTime($reservation->end_at)),
                                new Note($reservation->note)
                            );
                        }
                    )->toArray()
                )
                )
            )
        );
    }

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

        return array_map(fn (Room $room): Room => $room, $collections->toArray());
    }

    /**
     * @inheritdoc
     */
    public function store(Room $room): void
    {
        $storedRoom = EloquentRoom::find($room->getRoomId()->getValue());

        DB::transaction(function () use ($room, $storedRoom) {
            if ($storedRoom === null) {
                $storedRoom = new EloquentRoom([
                    'room_id' => (string)Str::uuid(),
                    'name' => $room->getRoomName()->getValue(),
                ]);
            } else {
                $storedRoom->name = $room->getRoomName()->getValue();
            }

            $storedRoom->save();

            // 予約は一度すべて消してからインサートしなおす。

            EloquentReservation::destroy(
                array_map(
                    fn (Reservation $reservation): string => $reservation->getReservationId()->getValue(),
                    $room->getReservations()
                )
            );

            EloquentReservation::insert(
                array_map(
                    function (Reservation $reservation): array {
                        return [
                            'room_id' => $reservation->getRoomId()->getValue(),
                            'reservation_id' => $reservation->getReservationId()->getValue(),
                            'summary' => $reservation->getSummary()->getValue(),
                            'start_at' => $reservation->getStartAt()->getValue()->format('Y/m/d H:i'),
                            'end_at' => $reservation->getEndAt()->getValue()->format('Y/m/d H:i'),
                            'note' => $reservation->getNote()->getValue(),
                        ];
                    },
                    $room->getReservations()
                ),
            );
        });
    }
}
