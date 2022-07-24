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
use packages\UseCase\Reservation\Update\ReservationUpdateRequest;
use packages\UseCase\Reservation\Update\ReservationUpdateResponse;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class MockReservationUpdateInteractor implements ReservationUpdateUseCaseInterface
{
    /**
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 予約の更新を行う。
     *
     * @param ReservationUpdateRequest $request
     *
     * @return ReservationUpdateResponse
     */
    public function handle(ReservationUpdateRequest $request): ReservationUpdateResponse
    {
        $updatedReservation = new Reservation(
            new RoomId($request->getRoomId()),
            new ReservationId($request->getReservationId()),
            new Summary($request->getSummary()),
            new StartAt(new DateTime($request->getStartAt())),
            new EndAt(new DateTime($request->getEndAt())),
            new Note($request->getNote())
        );

        return new ReservationUpdateResponse($updatedReservation);
    }
}
