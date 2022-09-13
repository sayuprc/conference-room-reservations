<?php

declare(strict_types=1);

namespace App\Http\ViewModels\ReservationTemplate\Common;

use DateTimeInterface;

class ReservationTemplateViewModel
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
     * @param int               $templateId
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
        $this->startAt = $startAt->format('H:i');
        $this->endAt = $endAt->format('H:i');
        $this->note = $note;
    }
}
