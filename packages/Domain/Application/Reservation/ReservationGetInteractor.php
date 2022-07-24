<?php

declare(strict_types=1);

namespace packages\Domain\Application\Reservation;

use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\RoomId;
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetResponse;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;

class ReservationGetInteractor implements ReservationGetUseCaseInterface
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
     * 予約の詳細を取得する。
     *
     * @param ReservationGetRequest $request
     *
     * @throws NotFoundException
     *
     * @return ReservationGetResponse
     */
    public function handle(ReservationGetRequest $request): ReservationGetResponse
    {
        $roomId = new RoomId($request->getRoomId());
        $reservationId = new ReservationId($request->getReservationId());

        $found = $this->repository->find($roomId, $reservationId);

        return new ReservationGetResponse($found);
    }
}
