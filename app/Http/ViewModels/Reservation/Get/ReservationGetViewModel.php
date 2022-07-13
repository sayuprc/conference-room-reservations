<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Reservation\Get;

use DateTimeInterface;

class ReservationGetViewModel
{
    /**
     * @var string $roomId
     */
    public string $roomId;

    /**
     * @var string $reservationId
     */
    public string $reservationId;

    /**
     * @var string $summary
     */
    public string $summary;

    /**
     * @var string $startAt
     */
    public string $startAt;

    /**
     * @var string $endAt
     */
    public string $endAt;

    /**
     * @var string $note
     */
    public string $note;

    /**
     * @param string            $roomId
     * @param string            $reservationId
     * @param string            $summary
     * @param DateTimeInterface $startAt
     * @param DateTimeInterface $endAt
     * @param string            $note
     *
     * @return void
     */
    public function __construct(
        string $roomId,
        string $reservationId,
        string $summary,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        string $note
    ) {
        $this->roomId = $roomId;
        $this->reservationId = $reservationId;
        $this->summary = $summary;
        $this->startAt = $startAt->format('m/d H:i');
        $this->endAt = $endAt->format('m/d H:i');
        $this->note = $note;
    }
}
