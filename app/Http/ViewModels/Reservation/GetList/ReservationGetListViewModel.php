<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Reservation\GetList;

use DateTimeInterface;

class ReservationGetListViewModel
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
     * @var string $detailUrl;
     */
    public string $detailUrl;

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
        $this->startAt = $startAt->format('H:i');
        $this->endAt = $endAt->format('H:i');
        // textareaのCRLFが画面上で再現できないのでエスケープする。
        $this->note = nl2br(e($note));

        $this->detailUrl = sprintf('/reservations/show/%s', $this->reservationId);
    }
}
