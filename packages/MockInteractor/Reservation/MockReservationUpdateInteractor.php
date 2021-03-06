<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Exception\PeriodicDuplicationException;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Reservation\ReservationService;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\RoomId;
use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Reservation\Update\ReservationUpdateRequest;
use packages\UseCase\Reservation\Update\ReservationUpdateResponse;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class MockReservationUpdateInteractor implements ReservationUpdateUseCaseInterface
{
    /**
     * @var ReservationRepositoryInterface $repository
     */
    private ReservationRepositoryInterface $repository;

    /**
     * @var ReservationService $service
     */
    private ReservationService $service;

    /**
     * @param ReservationRepositoryInterface $repository
     * @param ReservationService             $service
     *
     * @return void
     */
    public function __construct(ReservationRepositoryInterface $repository, ReservationService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * 予約の更新を行う。
     *
     * @param ReservationUpdateRequest $request
     *
     * @throws PeriodicDuplicationException
     * @throws NotFoundException
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

        if (! $this->service->exists($updatedReservation->getRoomId(), $updatedReservation->getReservationId())) {
            throw new NotFoundException(
                sprintf(
                    'RoomID: %s ReservationID: %s is not found.',
                    $updatedReservation->getRoomId()->getValue(),
                    $updatedReservation->getReservationId()->getValue()
                )
            );
        }

        if (! $this->service->canUpdated($updatedReservation)) {
            throw new PeriodicDuplicationException('There is a reservation for a specified period of time.');
        }

        $this->repository->update($updatedReservation);

        $reservationModel = new ReservationModel(
            $updatedReservation->getRoomId()->getValue(),
            $updatedReservation->getReservationId()->getValue(),
            $updatedReservation->getSummary()->getValue(),
            $updatedReservation->getStartAt()->getValue(),
            $updatedReservation->getEndAt()->getValue(),
            $updatedReservation->getNote()->getValue()
        );

        return new ReservationUpdateResponse($reservationModel);
    }
}
