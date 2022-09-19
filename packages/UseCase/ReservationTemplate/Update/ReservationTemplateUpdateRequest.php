<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Update;

class ReservationTemplateUpdateRequest
{
    /**
     * @var int $templateId
     */
    private int $templateId;

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
     * @var string $note
     */
    private string $note;

    /**
     * @param int    $templateId
     * @param string $sumamry
     * @param string $startAt
     * @param string $endAt
     * @param string $note
     *
     * @return void
     */
    public function __construct(
        int $templateId,
        string $sumamry,
        string $startAt,
        string $endAt,
        string $note
    ) {
        $this->templateId = $templateId;
        $this->summary = $sumamry;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }

    /**
     * 予約テンプレートIDを取得する。
     *
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    /**
     * 予約テンプレート概要を取得する。
     *
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * 予約テンプレート開始日時を取得する。
     *
     * @return string
     */
    public function getStartAt(): string
    {
        return $this->startAt;
    }

    /**
     * 予約テンプレート終了日時を取得する。
     *
     * @return string
     */
    public function getEndAt(): string
    {
        return $this->endAt;
    }

    /**
     * 予約テンプレート備考を取得する。
     *
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}
