<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\RoomId;

class InMemoryReservationRepository implements ReservationRepositoryInterface
{
    /**
     * @var array<string, Reservation> $db
     */
    private array $db;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->db = [];

        foreach (range(1, 20) as $i) {
            $roomId = new roomid((string)$i);

            foreach (range(1, 30) as $j) {
                $reservationId = new ReservationId((string)$j);
                $summary = new Summary('概要' . (string)$j);
                $startAt = new StartAt((new DateTime())->modify('+' . ($j - 1) . ' hours'));
                $endAt = new EndAt((new DateTime())->modify('+' . ($j - 1) . ' hours')->modify('+30 minutes'));
                $note = new Note(str_repeat('備考', $j));

                $this->db[$roomId->getValue()][$reservationId->getValue() ] = new Reservation(
                    $roomId,
                    $reservationId,
                    $summary,
                    $startAt,
                    $endAt,
                    $note
                );
            }
        }
    }

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
        $found = $this->db[$roomId->getValue()][$reservationId->getValue()] ?? null;

        return $found;
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
        return $this->db[$roomId->getValue()] ?? [];
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
        $found = array_values(
            array_filter($this->db, function (array $reservations) use ($reservationId): bool {
                return count(
                    array_filter(
                        $reservations,
                        function (Reservation $reservation) use ($reservationId): bool {
                            return $reservationId->equals($reservation->getReservationId());
                        }
                    )
                ) < 1 ? false : true;
            })
        )[0] ?? null;

        return $found;
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
        $this->db[$reservation->getRoomId()->getValue()][$reservation->getReservationId()->getValue()] = $reservation;

        dd($this->db);
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
        $this->db[$reservation->getRoomId()->getValue()][$reservation->getReservationId()->getValue()] = $reservation;

        dd($this->db);
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
        unset($this->db[$roomId->getValue()][$reservationId->getValue()]);

        dd($this->db);
    }
}
