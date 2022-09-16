<?php

declare(strict_types=1);

namespace packages\Domain\Domain\ReservationTemplate;

use Exception;
use InvalidArgumentException;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;

class ReservationTemplate
{
    /**
     * @var TemplateId|null $templateId
     */
    private ?TemplateId $templateId;

    /**
     * @var Summary $summary
     */
    private Summary $summary;

    /**
     * @var StartAt $startAt
     */
    private StartAt $startAt;

    /**
     * @var EndAt $endAt
     */
    private EndAt $endAt;

    /**
     * @var Note $note;
     */
    private Note $note;

    /**
     * @param TemplateId|null $templateId 自動採番なのでnullの場合がある
     * @param Summary         $summary
     * @param StartAt         $startAt
     * @param EndAt           $endAt
     * @param Note            $note
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(
        ?TemplateId $templateId,
        Summary $summary,
        StartAt $startAt,
        EndAt $endAt,
        Note $note
    ) {
        // 開始日と終了日の前後関係が逆転することはない
        if ($endAt->getValue()->format('H:i') < $startAt->getValue()->format('H:i')) {
            throw new InvalidArgumentException('values: ' . $startAt->getValue()->format('H:i') . ' and ' . $endAt->getValue()->format('H:i') . ' are invalid values.');
        }

        $this->templateId = $templateId;
        $this->summary = $summary;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }

    /**
     * 予約テンプレートIDのValueObjectを取得する。
     *
     * @throws Exception
     *
     * @return TemplateId
     */
    public function getTemplateId(): TemplateId
    {
        if ($this->templateId === null) {
            throw new Exception('template id is null.');
        }

        return $this->templateId;
    }

    /**
     * 予約概要のValueObjectを取得する。
     *
     * @return Summary
     */
    public function getSummary(): Summary
    {
        return $this->summary;
    }

    /**
     * 開始時間のValueObjectを取得する。
     *
     * @return StartAt
     */
    public function getStartAt(): StartAt
    {
        return $this->startAt;
    }

    /**
     * 終了時間のValueObjectを取得する。
     *
     * @return EndAt
     */
    public function getEndAt(): EndAt
    {
        return $this->endAt;
    }

    /**
     * 予約備考のValueObjectを取得する。
     *
     * @return Note
     */
    public function getNote(): Note
    {
        return $this->note;
    }
}
