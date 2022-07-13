<?php

declare(strict_types=1);

namespace packages\Domain\Application\Reservation;

use DateTime;
use Illuminate\Support\Str;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Reservation\Register\ReservationRegisterRequest;
use packages\UseCase\Reservation\Register\ReservationRegisterResponse;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;

class ReservationRegisterInteractor implements ReservationRegisterUseCaseInterface
{
    /**
     * @var
     */
    private RoomRepositoryInterface $repository;

    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ReservationRegisterRequest $request): ReservationRegisterResponse
    {
        $newReservation = new Reservation(
            new RoomId($request->getRoomId()),
            new ReservationId((string)Str::uuid()),
            new Summary($request->getSummary()),
            new StartAt(new DateTime($request->getStartAt())),
            new EndAt(new DateTime($request->getEndAt())),
            new Note($request->getNote())
        );

        $room = $this->repository->find($newReservation->getRoomId());

        $newRoom = $room->addReservation($newReservation);

        $this->repository->store($newRoom);

        return new ReservationRegisterResponse($newReservation);
    }
}
