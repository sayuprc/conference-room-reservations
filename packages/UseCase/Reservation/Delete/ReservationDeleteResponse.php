<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Delete;

class ReservationDeleteResponse
{
    /**
     * @var string $roomId;
     */
    private string $roomId;

    /**
     * @param string $roomId;
     *
     * @return void
     */
    public function __construct(string $roomId)
    {
        $this->roomId = $roomId;
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
}
