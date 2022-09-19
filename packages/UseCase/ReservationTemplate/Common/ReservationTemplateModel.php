<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Common;

use DateTimeInterface;

class ReservationTemplateModel
{
    /**
     * @var int $templateId
     */
    public int $templateId;

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
        int $templateId,
        string $summary,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        string $note
    ) {
        $this->templateId = $templateId;
        $this->summary = $summary;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }
}
