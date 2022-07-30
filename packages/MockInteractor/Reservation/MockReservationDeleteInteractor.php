<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Room\RoomId;
use packages\UseCase\Reservation\Delete\ReservationDeleteRequest;
use packages\UseCase\Reservation\Delete\ReservationDeleteResponse;
use packages\UseCase\Reservation\Delete\ReservationDeleteUseCaseInterface;

class MockReservationDeleteInteractor implements ReservationDeleteUseCaseInterface
{
    /**
     * @var ReservationRepositoryInterface $repository
     */
    private ReservationRepositoryInterface $repository;

    /**
     * @param ReservationRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(ReservationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 予約を削除する。
     *
     * @param ReservationDeleteRequest $request
     *
     * @return ReservationDeleteResponse
     */
    public function handle(ReservationDeleteRequest $request): ReservationDeleteResponse
    {
        $roomId = new RoomId($request->getRoomId());

        $reservationId = new ReservationId($request->getReservationId());

        $this->repository->delete($roomId, $reservationId);

        return new ReservationDeleteResponse($roomId->getValue());
    }
}
