<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Reservation;

use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Room\Exception\NotFoundException;
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
    }

    /**
     * 会議室IDと予約IDで予約を検索する。
     *
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     *
     * @throws NotFoundException
     *
     * @return Reservation
     */
    public function find(RoomId $roomId, ReservationId $reservationId): Reservation
    {
        $found = $this->db[$reservationId->getValue()] ?? null;

        if ($found === null) {
            throw new NotFoundException('ID: ' . $reservationId->getValue() . ' is not found.');
        }

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
        return array_filter($this->db, function (Reservation $reservation) use ($roomId): bool {
            return $reservation->getRoomId()->getValue() === $roomId->getValue();
        });
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
        $this->db[$reservation->getReservationId()->getValue()] = $reservation;
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
        $this->db[$reservation->getReservationId()->getValue()] = $reservation;
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
        unset($this->db[$reservationId->getValue()]);
    }
}
