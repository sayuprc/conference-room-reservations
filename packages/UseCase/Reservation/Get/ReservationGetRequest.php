<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Get;

class ReservationGetRequest
{
    /**
     * @var string string $roomId
     */
    private string $roomId;

    /**
     * @var string $reservationId
     */
    private string $reservationId;

    /**
     * @param string $roomId
     * @param string $reservationId
     *
     * @return void
     */
    public function __construct(string $roomId, string $reservationId)
    {
        $this->roomId = $roomId;
        $this->reservationId = $reservationId;
    }

    /**
     * 会議室IDを取得する。
     *
     * @return string
     */
    public function getRoomId(): string
    {
        return $this->roomId;
    }

    /**
     * 予約IDを取得する。
     *
     * @return string
     */
    public function getReservationId(): string
    {
        return $this->reservationId;
    }
}
