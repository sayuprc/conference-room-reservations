<?php

declare(strict_types=1);

namespace packages\Domain\Application\ReservationTemplate;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterRequest;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterResponse;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterUseCaseInterface;

class ReservationTemplateRegisterInteractor implements ReservationTemplateRegisterUseCaseInterface
{
    /**
     * @var ReservationTemplateRepositoryInterface $reservationTemplateRepository
     */
    private ReservationTemplateRepositoryInterface $reservationTemplateRepository;

    /**
     * @param ReservationTemplateRepositoryInterface $reservationTemplateRepository
     *
     * @return void
     */
    public function __construct(ReservationTemplateRepositoryInterface $reservationTemplateRepository)
    {
        $this->reservationTemplateRepository = $reservationTemplateRepository;
    }

    /**
     * 予約テンプレートの登録処理を実行する。
     *
     * @param ReservationTemplateRegisterRequest $request
     *
     * @return ReservationTemplateRegisterResponse
     */
    public function handle(ReservationTemplateRegisterRequest $request): ReservationTemplateRegisterResponse
    {
        $newTemplate = new ReservationTemplate(
            null,
            new Summary($request->getSummary()),
            new StartAt(new DateTime($request->getStartAt())),
            new EndAt(new DateTime($request->getEndAt())),
            new Note($request->getNote())
        );

        $this->reservationTemplateRepository->insert($newTemplate);

        return new ReservationTemplateRegisterResponse();
    }
}
