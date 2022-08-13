<?php

declare(strict_types=1);

namespace packages\Infrastructure\Reservation;

use App\Models\Reservation as EloquentReservation;
use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\RoomId;

class ReservationRepository implements ReservationRepositoryInterface
{
    /**
     * 会議室IDと予約IDで予約を検索する。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @return Reservation|null
     */
    public function find(RoomId $roomId, ReservationId $reservationId): ?Reservation
    {
        $found = EloquentReservation::where([
            'room_id' => $roomId->getValue(),
            'reservation_id' => $reservationId->getValue(),
        ])->get()[0] ?? null;

        if ($found === null) {
            return $found;
        }

        return new Reservation(
            $roomId,
            $reservationId,
            new Summary($found->summary),
            new StartAt(new DateTime($found->start_at)),
            new EndAt(new DateTime($found->end_at)),
            new Note($found->note)
        );
    }

    /**
     * 会議室IDで予約を検索する。
     *
     * @param RoomId $roomId
     *
     * @return array<Reservation>
     */
    public function findByRoomId(RoomId $roomId): array
    {
        $collections = EloquentReservation::where(['room_id' => $roomId->getValue()])->get()->map(
            function (EloquentReservation $reservation) use ($roomId): Reservation {
                return new Reservation(
                    $roomId,
                    new ReservationId($reservation->reservation_id),
                    new Summary($reservation->summary),
                    new StartAt(new DateTime($reservation->start_at)),
                    new EndAt(new DateTime($reservation->end_at)),
                    new Note($reservation->note)
                );
            }
        );

        return array_map(fn (Reservation $reservation): Reservation => $reservation, $collections->toArray());
    }

    /**
     * 予約IDで予約を検索する。
     *
     * @param ReservationId $reservationId
     *
     * @return Reservation|null
     */
    public function findByReservationId(ReservationId $reservationId): ?Reservation
    {
        $found = EloquentReservation::find($reservationId->getValue());

        if ($found === null) {
            return $found;
        }

        return new Reservation(
            new RoomId($found->room_id),
            new ReservationId($found->reservation_id),
            new Summary($found->summary),
            new StartAt(new DateTime($found->start_at)),
            new EndAt(new DateTime($found->end_at)),
            new Note($found->note)
        );
    }

    /**
     * 予約を新規登録する。
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function insert(Reservation $reservation): void
    {
        $newReservation = new EloquentReservation([
            'room_id' => $reservation->getRoomId()->getValue(),
            'reservation_id' => $reservation->getReservationId()->getValue(),
            'summary' => $reservation->getSummary()->getValue(),
            'start_at' => $reservation->getStartAt()->getValue()->format('Y/m/d H:i:s'),
            'end_at' => $reservation->getEndAt()->getValue()->format('Y/m/d H:i:s'),
            'note' => $reservation->getNote()->getValue(),
        ]);

        $newReservation->save();
    }

    /**
     * 予約を更新する。
     *
     * @param Reservation $reservation
     *
     * @throws NotFoundException
     *
     * @return void
     */
    public function update(Reservation $reservation): void
    {
        $found = EloquentReservation::find($reservation->getReservationId()->getValue());

        if ($found === null) {
            throw new NotFoundException('ID: ' . $reservation->getReservationId()->getValue() . ' is not found.');
        }

        $found->room_id = $reservation->getRoomId()->getValue();
        $found->summary = $reservation->getSummary()->getValue();
        $found->start_at = $reservation->getStartAt()->getValue()->format('Y/m/d H:i');
        $found->end_at = $reservation->getEndAt()->getValue()->format('Y/m/d H:i');
        $found->note = $reservation->getNote()->getValue();

        $found->save();
    }

    /**
     * 予約を削除する。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @return void
     */
    public function delete(RoomId $roomId, ReservationId $reservationId): void
    {
        EloquentReservation::where([
            'room_id' => $roomId->getValue(),
            'reservation_id' => $reservationId->getValue(),
        ])->delete();
    }
}
