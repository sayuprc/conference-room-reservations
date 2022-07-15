<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationSpecification;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\RoomId;
use PHPUnit\Framework\TestCase;

class ReservationSpecificationTest extends TestCase
{
    /**
     * フィルターのテスト
     *
     * @return void
     */
    public function testFilterSpecification()
    {
        $specification = new ReservationSpecification();

        $roomId = new RoomId('1');

        $filterd = $specification->removeFinished(
            [
                // 本日開始予定
                new Reservation(
                    $roomId,
                    new ReservationId('1'),
                    new Summary('本日開始'),
                    new StartAt(new DateTime()),
                    new EndAt((new DateTime())->modify('+30 minute')),
                    new Note('')
                ),
                // 翌日開始予定
                new Reservation(
                    $roomId,
                    new ReservationId('2'),
                    new Summary('1日後開始'),
                    new StartAt((new DateTime(''))->modify('+1 days')),
                    new EndAt((new DateTime())->modify('+1 days')->modify('+30 minute')),
                    new Note('')
                ),
                // 1日前開始(終了済み)
                new Reservation(
                    $roomId,
                    new ReservationId('3'),
                    new Summary('1日前開始'),
                    new StartAt((new DateTime())->modify('-1 days')),
                    new EndAt((new DateTime())->modify('-1 days')->modify('+30 minute')),
                    new Note('')
                ),
                // 1日前開始(終了していない)
                new Reservation(
                    $roomId,
                    new ReservationId('3'),
                    new Summary('1日前開始'),
                    new StartAt((new DateTime())->modify('-1 days')),
                    new EndAt((new DateTime())->modify('+3 days')->modify('+30 minute')),
                    new Note('')
                ),
            ]
        );

        $this->assertCount(3, $filterd);
    }
}
