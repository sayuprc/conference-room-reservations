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
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;
use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Reservation\Update\ReservationUpdateRequest;
use packages\UseCase\Reservation\Update\ReservationUpdateResponse;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class MockReservationUpdateInteractor implements ReservationUpdateUseCaseInterface
{
    /**
     * @var RoomRepositoryInterface $roomRepository
     */
    private RoomRepositoryInterface $roomRepository;

    /**
     * @var ReservationRepositoryInterface $reservationRepository
     */
    private ReservationRepositoryInterface $reservationRepository;

    /**
     * @var ReservationService $service
     */
    private ReservationService $service;

    /**
     * @var SlackAPIRepositoryInterface $slackAPIRepository
     */
    private SlackAPIRepositoryInterface $slackAPIRepository;

    /**
     * @param RoomRepositoryInterface        $roomRepository
     * @param ReservationRepositoryInterface $reservationRepository
     * @param ReservationService             $service
     * @param SlackAPIRepositoryInterface    $slackAPIRepository
     *
     * @return void
     */
    public function __construct(
        RoomRepositoryInterface $roomRepository,
        ReservationRepositoryInterface $reservationRepository,
        ReservationService $service,
        SlackAPIRepositoryInterface $slackAPIRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->reservationRepository = $reservationRepository;
        $this->service = $service;
        $this->slackAPIRepository = $slackAPIRepository;
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

        $room = $this->roomRepository->find($updatedReservation->getRoomId());

        if ($room === null) {
            throw new NotFoundException(
                sprintf('ID: %s is not found.', $updatedReservation->getReservationId()->getValue())
            );
        }

        if (! $this->service->canUpdated($updatedReservation)) {
            throw new PeriodicDuplicationException('There is a reservation for a specified period of time.');
        }

        $this->reservationRepository->update($updatedReservation);

        $reservationModel = new ReservationModel(
            $updatedReservation->getRoomId()->getValue(),
            $updatedReservation->getReservationId()->getValue(),
            $updatedReservation->getSummary()->getValue(),
            $updatedReservation->getStartAt()->getValue(),
            $updatedReservation->getEndAt()->getValue(),
            $updatedReservation->getNote()->getValue()
        );

        $showLimit = 25;

        $this->slackAPIRepository->postMessage(
            sprintf(
                "予約が更新されました。\n```会議室名: %s\n概要: %s\n日時: %s ~ %s\n備考: %s```\n%s/reservations/show/%s",
                $room->getRoomName()->getValue(),
                $reservationModel->summary,
                $reservationModel->startAt->format('Y/m/d H:i'),
                $reservationModel->endAt->format('Y/m/d H:i'),
                // 25文字以上は...にする
                $showLimit < mb_strlen($reservationModel->note)
                    ? mb_substr($reservationModel->note, 0, $showLimit) . '...'
                    : $reservationModel->note,
                config('app.url'),
                $reservationModel->reservationId
            )
        );

        return new ReservationUpdateResponse($reservationModel);
    }
}
