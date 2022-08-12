<?php

declare(strict_types=1);

namespace packages\Domain\Application\Reservation;

use DateTime;
use Illuminate\Support\Str;
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
use packages\Domain\Domain\Room\RoomService;
use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;
use packages\UseCase\Reservation\Common\ReservationModel;
use packages\UseCase\Reservation\Register\ReservationRegisterRequest;
use packages\UseCase\Reservation\Register\ReservationRegisterResponse;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;

class ReservationRegisterInteractor implements ReservationRegisterUseCaseInterface
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
     * @var RoomService $roomService
     */
    private RoomService $roomService;

    /**
     * @var SlackAPIRepositoryInterface $slackAPIRepository
     */
    private SlackAPIRepositoryInterface $slackAPIRepository;

    /**
     * @param ReservationRepositoryInterface $repository
     * @param ReservationService             $service
     * @param RoomService                    $roomService
     * @param SlackAPIRepositoryInterface    $slackAPIRepository
     *
     * @return void
     */
    public function __construct(
        ReservationRepositoryInterface $repository,
        ReservationService $service,
        RoomService $roomService,
        SlackAPIRepositoryInterface $slackAPIRepository
    ) {
        $this->repository = $repository;

        $this->service = $service;

        $this->roomService = $roomService;

        $this->slackAPIRepository = $slackAPIRepository;
    }

    /**
     * 予約の登録処理を実行する。
     *
     * @param ReservationRegisterRequest $request
     *
     * @throws PeriodicDuplicationException
     * @throws NotFoundException
     *
     * @return ReservationRegisterResponse
     */
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

        if (! $this->roomService->exists($newReservation->getRoomId())) {
            throw new NotFoundException('ID: ' . $newReservation->getRoomId()->getValue() . ' is not found.');
        }

        if (! $this->service->canRegistered($newReservation)) {
            throw new PeriodicDuplicationException('There is a reservation for a specified period of time.');
        }

        $this->repository->insert($newReservation);

        $reservationModel = new ReservationModel(
            $newReservation->getRoomId()->getValue(),
            $newReservation->getReservationId()->getValue(),
            $newReservation->getSummary()->getValue(),
            $newReservation->getStartAt()->getValue(),
            $newReservation->getEndAt()->getValue(),
            $newReservation->getNote()->getValue()
        );

        $showLimit = 25;

        $this->slackAPIRepository->postMessage(
            sprintf(
                "予約が登録されました。\n```概要: %s\n日時: %s ~ %s\n備考: %s```\n%s/reservations/show/%s/%s",
                $reservationModel->summary,
                $reservationModel->startAt->format('Y/m/d H:i'),
                $reservationModel->endAt->format('Y/m/d H:i'),
                // 25文字以上は...にする
                $showLimit < mb_strlen($reservationModel->note)
                    ? mb_substr($reservationModel->note, 0, $showLimit) . '...'
                    : $reservationModel->note,
                config('app.url'),
                $reservationModel->roomId,
                $reservationModel->reservationId
            )
        );

        return new ReservationRegisterResponse($reservationModel);
    }
}
