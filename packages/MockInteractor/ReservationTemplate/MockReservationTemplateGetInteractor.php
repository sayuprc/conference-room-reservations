<?php

declare(strict_types=1);

namespace packages\MockInteractor\ReservationTemplate;

use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\TemplateId;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetRequest;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetResponse;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetUseCaseInterface;

class MockReservationTemplateGetInteractor implements ReservationTemplateGetUseCaseInterface
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
     * 予約テンプレートを取得する。
     *
     * @param ReservationTemplateGetRequest $request
     *
     * @throws NotFoundException
     *
     * @return ReservationTemplateGetResponse
     */
    public function handle(ReservationTemplateGetRequest $request): ReservationTemplateGetResponse
    {
        $templateId = $request->getTemplateId();

        $found = $this->reservationTemplateRepository->find(new TemplateId($templateId));

        if ($found === null) {
            throw new NotFoundException('ID: ' . $templateId . ' is not found.');
        }

        $templateModel = new ReservationTemplateModel(
            $found->getTemplateId()->getValue(),
            $found->getSummary()->getValue(),
            $found->getStartAt()->getValue(),
            $found->getEndAt()->getValue(),
            $found->getNote()->getValue()
        );

        return new ReservationTemplateGetResponse($templateModel);
    }
}
