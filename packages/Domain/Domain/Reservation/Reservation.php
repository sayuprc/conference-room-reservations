<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Reservation;

use InvalidArgumentException;
use packages\Domain\Domain\Room\RoomId;

class Reservation
{
    /**
     * @var RoomId $roomId
     */
    private RoomId $roomId;

    /**
     * @var ReservationId $reservationId
     */
    private ReservationId $reservationId;

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
     * @param RoomId        $roomId
     * @param ReservationId $reservationId
     * @param Summary       $summary
     * @param StartAt       $startAt
     * @param EndAt         $endAt
     * @param Note          $note
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __construct(RoomId $roomId, ReservationId $reservationId, Summary $summary, StartAt $startAt, EndAt $endAt, Note $note)
    {
        // 開始日と終了日の前後関係が逆転することはない
        if ($endAt->getValue()->format('Y/m/d H:i') < $startAt->getValue()->format('Y/m/d H:i')) {
            throw new InvalidArgumentException('values: ' . $startAt->getValue()->format('Y/m/d H:i') . ' and ' . $endAt->getValue()->format('Y/m/d H:i') . ' are invalid values.');
        }

        $this->roomId = $roomId;
        $this->reservationId = $reservationId;
        $this->summary = $summary;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->note = $note;
    }

    /**
     * 会議室IDのValueObjectを取得する。
     *
     * @return RoomId
     */
    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    /**
     * 予約IDのValueObjectを取得する。
     *
     * @return ReservationId
     */
    public function getReservationId(): ReservationId
    {
        return $this->reservationId;
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
     * 開始日時のValueObjectを取得する。
     *
     * @return StartAt
     */
    public function getStartAt(): StartAt
    {
        return $this->startAt;
    }

    /**
     * 終了日時のValueObjectを取得する。
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
