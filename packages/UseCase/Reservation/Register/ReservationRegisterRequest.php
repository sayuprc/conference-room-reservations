<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Register;

class ReservationRegisterRequest
{
    /**
     * @var string $roomId
     */
    private string $roomId;

    /**
     * @var string $summary
     */
    private string $summary;

    /**
     * @var string $startAt
     */
    private string $startAt;

    /**
     * @var string $endAt
     */
    private string $endAt;

    /**
     * @var string $note;
     */
    private string $note;

    public function __construct(string $roomId, string $sumamry, string $startAt, string $endAt, string $note)
    {
        $this->roomId = $roomId;
        $this->summary = $sumamry;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getStartAt(): string
    {
        return $this->startAt;
    }

    public function getEndAt(): string
    {
        return $this->endAt;
    }

    public function getNote(): string
    {
        return $this->note;
    }
}
