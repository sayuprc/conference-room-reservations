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
     * @var string $startAtDate
     */
    public string $startAtDate;

    /**
     * @var string $startAtTime
     */
    public string $startAtTime;

    /**
     * @var string $endAtDate
     */
    public string $endAtDate;

    /**
     * @var string $endAtTime
     */
    public string $endAtTime;

    /**
     * @var string $note
     */
    public string $note;

    /**
     * @var string $roomUrl;
     */
    public string $roomUrl;

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
        $this->startAtDate = $startAt->format('Y-m-d');
        $this->startAtTime = $startAt->format('H:i');
        $this->endAtDate = $endAt->format('Y-m-d');
        $this->endAtTime = $endAt->format('H:i');
        $this->note = $note;

        $this->roomUrl = sprintf('/rooms/show/%s', $this->roomId);
    }
}
