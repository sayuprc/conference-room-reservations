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
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetResponse;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;

class MockReservationGetInteractor implements ReservationGetUseCaseInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 予約の詳細を取得する。
     *
     * @param ReservationGetRequest $request
     *
     * @return ReservationGetResponse
     */
    public function handle(ReservationGetRequest $request): ReservationGetResponse
    {
        $roomId = new RoomId($request->getRoomId());
        $reservationId = new ReservationId($request->getReservationId());

        return new ReservationGetResponse(
            new Reservation(
                $roomId,
                $reservationId,
                new Summary(' '),
                new StartAt(new DateTime()),
                new  EndAt(new DateTime()),
                new Note('')
            )
        );
    }
}
