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
use packages\Domain\Domain\Room\RoomId;

class ReservationRepository implements ReservationRepositoryInterface
{
    /**
     * 予約IDで予約を検索する。
     *
     * @param ReservationId $reservationId
     *
     * @return Reservation
     */
    public function find(ReservationId $reservationId): Reservation
    {
        // TODO 後で実装する。
        return new Reservation(
            new RoomId('1'),
            $reservationId,
            new Summary('   '),
            new StartAt(new DateTime()),
            new EndAt(new DateTime()),
            new Note('')
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
     * @return void
     */
    public function update(Reservation $reservation): void
    {
        // TODO 後で実装する。
    }

    /**
     * 予約を削除する。
     *
     * @param Reservation $reservation
     *
     * @return void
     */
    public function delete(Reservation $reservation): void
    {
        // TODO 後で実装する。
    }
}
