<?php

declare(strict_types=1);

namespace packages\MockInteractor\Room;

use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Reservation\ReservationSpecification;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Room\Common\RoomModel;
use packages\UseCase\Room\Get\RoomGetRequest;
use packages\UseCase\Room\Get\RoomGetResponse;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;

class MockRoomGetInteractor implements RoomGetUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $repository
     */
    private RoomRepositoryInterface $repository;

    /**
     * @var ReservationRepositoryInterface $reservationRepository
     */
    private ReservationRepositoryInterface $reservationRepository;

    /**
     * @var ReservationSpecification $reservationSpecification
     */
    private ReservationSpecification $reservationSpecification;

    /**
     * @param RoomRepositoryInterface        $repository
     * @param ReservationRepositoryInterface $reservationRepository
     * @param ReservationSpecification       $reservationSpecification
     *
     * @return void
     */
    public function __construct(
        RoomRepositoryInterface $repository,
        ReservationRepositoryInterface $reservationRepository,
        ReservationSpecification $reservationSpecification
    ) {
        $this->repository = $repository;
        $this->reservationRepository = $reservationRepository;
        $this->reservationSpecification = $reservationSpecification;
    }

    /**
     * 特定の会議室を取得する。
     *
     * @param RoomGetRequest $request
     *
     * @return RoomGetResponse
     */
    public function handle(RoomGetRequest $request): RoomGetResponse
    {
        $roomId = new RoomId($request->roomId);

        $foundRoom = $this->repository->find($roomId);

        $foundReservation = $this->reservationRepository->findByRoomId($roomId);

        return new RoomGetResponse(
            new RoomModel($foundRoom->getRoomId()->getValue(), $foundRoom->getRoomName()->getValue()),
            $this->reservationSpecification->orderByStartAtAsc($this->reservationSpecification->removeFinished($foundReservation))
        );
    }
}
