<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Reservation\Common;

use DateTimeInterface;

class ReservationViewModel
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
     * @var DateTimeInterface $startAt
     */
    public DateTimeInterface $startAt;

    /**
     * @var DateTimeInterface $endAt
     */
    public DateTimeInterface $endAt;

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
    )
    {
        $this->roomId = $roomId;
        $this->reservationId = $reservationId;
        $this->summary = $summary;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }
}
