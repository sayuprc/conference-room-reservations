<?php

declare(strict_types=1);

namespace packages\Domain\Application\Reservation;

use packages\Domain\Domain\Reservation\Reservation;
use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetResponse;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;

class ReservationGetInteractor implements ReservationGetUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $repository
     */
    private RoomRepositoryInterface $repository;

    /**
     * @param RoomRepositoryInterface $repository
     *
     * @return void
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     *
     * @throws NotFoundException
     */
    public function handle(ReservationGetRequest $request): ReservationGetResponse
    {
        $roomId = new RoomId($request->getRoomId());
        $reservationId = new ReservationId($request->getReservationId());

        // キーを振りなおすため、配列にマージする。
        $found = [...array_filter(
            $this->repository->find($roomId)->getReservations(),
            function (Reservation $reservation) use ($reservationId): bool {
                return $reservation->getReservationId()->equals($reservationId);
            }
        )];

        if (count($found) !== 1) {
            throw new NotFoundException('ID: ' . $reservationId->getValue() . ' is not found.');
        }

        $reservation = new Reservation(
            $found[0]->getRoomId(),
            $found[0]->getReservationId(),
            $found[0]->getSummary(),
            $found[0]->getStartAt(),
            $found[0]->getEndAt(),
            $found[0]->getNote()
        );

        return new ReservationGetResponse($reservation);
    }
}
