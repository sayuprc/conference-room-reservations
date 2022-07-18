<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Exception\PeriodicDuplicationException;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationService;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Reservation\Update\ReservationUpdateRequest;
use packages\UseCase\Reservation\Update\ReservationUpdateResponse;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class MockReservationUpdateInteractor implements ReservationUpdateUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $repository
     */
    private RoomRepositoryInterface $repository;

    /**
     * @var ReservationService $service
     */
    private ReservationService $service;

    /**
     * @param RoomRepositoryInterface $repository
     * @param ReservationService      $service
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $repository, ReservationService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @inheritdoc
     *
     * @throws PeriodicDuplicationException
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

        if (! $this->service->canUpdated($updatedReservation)) {
            throw new PeriodicDuplicationException('There is a reservation for a specified period of time.');
        }

        $room = $this->repository->find($updatedReservation->getRoomId());

        // 一度対象の予約を削除してから再度会議室に追加する。
        $updatedRoom = $room
            ->removeReservation($updatedReservation->getReservationId())
            ->addReservation($updatedReservation);

        $this->repository->store($updatedRoom);

        return new ReservationUpdateResponse($updatedReservation);
    }
}
