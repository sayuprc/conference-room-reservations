<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use packages\Domain\Domain\Reservation\ReservationId;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\Room\Room;
use packages\Domain\Domain\Room\RoomId;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Reservation\Get\ReservationGetRequest;
use packages\UseCase\Reservation\Get\ReservationGetResponse;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;
use packages\UseCase\Room\Common\RoomModel;

class MockReservationGetInteractor implements ReservationGetUseCaseInterface
{
    /**
     * @var ReservationRepositoryInterface $reservationRepository
     */
    private ReservationRepositoryInterface $reservationRepository;

    /**
     * @var RoomRepositoryInterface $roomRepository
     */
    private RoomRepositoryInterface $roomRepository;

    /**
     * @param ReservationRepositoryInterface $reservationRepository
     * @param RoomRepositoryInterface        $roomRepository
     *
     * @return void
     */
    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        RoomRepositoryInterface $roomRepository
    ) {
        $this->reservationRepository = $reservationRepository;

        $this->roomRepository = $roomRepository;
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

        $found = $this->reservationRepository->find($roomId, $reservationId);

        $reservationModel = new ReservationModel(
            $found->getRoomId()->getValue(),
            $found->getReservationId()->getValue(),
            $found->getSummary()->getValue(),
            $found->getStartAt()->getValue(),
            $found->getEndAt()->getValue(),
            $found->getNote()->getValue()
        );

        $roomModels = array_map(function (Room $room): RoomModel {
            return new RoomModel($room->getRoomId()->getValue(), $room->getRoomName()->getValue());
        }, $this->roomRepository->findAll());

        return new ReservationGetResponse($reservationModel, $roomModels);
    }
}
