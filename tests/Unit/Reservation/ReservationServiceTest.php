<?php

declare(strict_types=1);

namespace Tests\Unit\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationService;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomName;
use packages\InMemoryInfrastructure\Room\InMemoryRoomRepository;
use PHPUnit\Framework\TestCase;

class ReservationServiceTest extends TestCase
{
    /**
     * 登録可能判断メソッドのテスト(登録可能パターン)
     *
     * @return void
     */
    public function testCanRegister(): void
    {
        $repository = new InMemoryRoomRepository();

        $service = new ReservationService($repository);

        $roomId = new RoomId('1');

        $repository->store(new Room(
            $roomId,
            new RoomName('テスト'),
            [
                new Reservation(
                    $roomId,
                    new ReservationId('1'),
                    new Summary('予約 A'),
                    new StartAt(new DateTime('2022/07/01 10:00')),
                    new EndAt(new DateTime('2022/07/01 11:30')),
                    new Note('')
                ),
            ]
        ));

        // 予約Aの後に開始
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 12:00')),
            new EndAt(new DateTime('2022/07/01 21:00')),
            new Note('')
        );
        $this->assertTrue($service->canRegistered($newReservation));

        // 予約Aの前に終了
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 09:00')),
            new EndAt(new DateTime('2022/07/01 09:30')),
            new Note('')
        );
        $this->assertTrue($service->canRegistered($newReservation));
    }

    /**
     * 登録可能判断メソッドのテスト(登録不可能パターン)
     *
     * @return void
     */
    public function testFailureCanRegister(): void
    {
        $repository = new InMemoryRoomRepository();

        $service = new ReservationService($repository);

        $roomId = new RoomId('1');

        $repository->store(new Room(
            $roomId,
            new RoomName('テスト'),
            [
                new Reservation(
                    $roomId,
                    new ReservationId('1'),
                    new Summary('予約 A'),
                    new StartAt(new DateTime('2022/07/01 10:00')),
                    new EndAt(new DateTime('2022/07/01 11:30')),
                    new Note('')
                ),
            ]
        ));

        // 予約Aの開始日と被る
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 10:30')),
            new EndAt(new DateTime('2022/07/01 21:00')),
            new Note('')
        );
        $this->assertFalse($service->canRegistered($newReservation));

        // 予約Aの終了日と被る
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 09:00')),
            new EndAt(new DateTime('2022/07/01 11:20')),
            new Note('')
        );
        $this->assertFalse($service->canRegistered($newReservation));

        // 予約Aの開始日と終了日に収まる
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 10:20')),
            new EndAt(new DateTime('2022/07/01 11:20')),
            new Note('')
        );
        $this->assertFalse($service->canRegistered($newReservation));

        // 予約Aの開始日と終了日を含める
        $newReservation = new Reservation(
            $roomId,
            new ReservationId('3'),
            new Summary('重複'),
            new StartAt(new DateTime('2022/07/01 09:20')),
            new EndAt(new DateTime('2022/07/01 12:00')),
            new Note('')
        );
        $this->assertFalse($service->canRegistered($newReservation));
    }
}
