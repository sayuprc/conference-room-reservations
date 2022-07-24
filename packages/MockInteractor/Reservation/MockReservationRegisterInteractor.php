<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\RoomId;
use packages\UseCase\Reservation\Register\ReservationRegisterRequest;
use packages\UseCase\Reservation\Register\ReservationRegisterResponse;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;

class MockReservationRegisterInteractor implements ReservationRegisterUseCaseInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 予約の登録を実行する。
     *
     * @param ReservationRegisterRequest $request
     *
     * @return ReservationRegisterResponse
     */
    public function handle(ReservationRegisterRequest $request): ReservationRegisterResponse
    {
        return new ReservationRegisterResponse(
            new Reservation(
                new RoomId('1'),
                new ReservationId('1'),
                new Summary(' '),
                new StartAt(new DateTime()),
                new EndAt(new DateTime()),
                new Note()
            )
        );
    }
}
