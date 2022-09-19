<?php

declare(strict_types=1);

namespace packages\MockInteractor\ReservationTemplate ;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\TemplateId;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateRequest;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateResponse;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateUseCaseInterface;

class MockReservationTemplateUpdateInteractor implements ReservationTemplateUpdateUseCaseInterface
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
     * 予約テンプレートの更新を行う。
     *
     * @param ReservationTemplateUpdateRequest $request
     *
     * @return ReservationTemplateUpdateResponse
     */
    public function handle(ReservationTemplateUpdateRequest $request): ReservationTemplateUpdateResponse
    {
        $template = new ReservationTemplate(
            new TemplateId($request->getTemplateId()),
            new Summary($request->getSummary()),
            new StartAt(new DateTime($request->getStartAt())),
            new EndAt(new DateTime($request->getEndAt())),
            new Note($request->getNote())
        );

        $this->reservationTemplateRepository->update($template);

        return new ReservationTemplateUpdateResponse($template->getTemplateId()->getValue());
    }
}
