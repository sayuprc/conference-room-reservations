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
     * @var string $note
     */
    private string $note;

    /**
     * @param string $roomId
     * @param string $sumamry
     * @param string $startAt
     * @param string $endAt
     * @param string $note
     *
     * @return void
     */
    public function __construct(string $roomId, string $sumamry, string $startAt, string $endAt, string $note)
    {
        $this->roomId = $roomId;
        $this->summary = $sumamry;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
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

    /**
     * 予約概要を取得する。
     *
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * 予約開始日時を取得する。
     *
     * @return string
     */
    public function getStartAt(): string
    {
        return $this->startAt;
    }

    /**
     * 予約終了日時を取得する。
     *
     * @return string
     */
    public function getEndAt(): string
    {
        return $this->endAt;
    }

    /**
     * 予約備考を取得する。
     *
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}
