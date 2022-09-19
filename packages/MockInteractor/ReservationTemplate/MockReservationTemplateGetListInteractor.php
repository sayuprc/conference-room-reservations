<?php

declare(strict_types=1);

namespace packages\MockInteractor\ReservationTemplate;

use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateSpecification;
use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListRequest;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListResponse;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListUseCaseInterface;

class MockReservationTemplateGetListInteractor implements ReservationTemplateGetListUseCaseInterface
{
    /**
     * @var ReservationTemplateRepositoryInterface $reservationTemplateRepository
     */
    private ReservationTemplateRepositoryInterface $reservationTemplateRepository;

    /**
     * @var ReservationTemplateSpecification $reservationTemplateSpecification
     */
    private ReservationTemplateSpecification $reservationTemplateSpecification;

    /**
     * @param ReservationTemplateRepositoryInterface $reservationTemplateRepository
     * @param ReservationTemplateSpecification       $reservationTemplateSpecification
     *
     * @return void
     */
    public function __construct(
        ReservationTemplateRepositoryInterface $reservationTemplateRepository,
        ReservationTemplateSpecification $reservationTemplateSpecification
    ) {
        $this->reservationTemplateRepository = $reservationTemplateRepository;

        $this->reservationTemplateSpecification = $reservationTemplateSpecification;
    }

    /**
     * 予約テンプレートの一覧を取得する。
     *
     * @param ReservationTemplateGetListRequest $request
     *
     * @return ReservationTemplateGetListResponse
     */
    public function handle(ReservationTemplateGetListRequest $request): ReservationTemplateGetListResponse
    {
        /**
         * @var array<ReservationTemplateModel> $templateModels
         */
        $templateModels = array_map(
            function (ReservationTemplate $template): ReservationTemplateModel {
                return new ReservationTemplateModel(
                    $template->getTemplateId()->getValue(),
                    $template->getSummary()->getValue(),
                    $template->getStartAt()->getValue(),
                    $template->getEndAt()->getValue(),
                    $template->getNote()->getValue()
                );
            },
            $this->reservationTemplateSpecification->orderByTemplateIdAsc($this->reservationTemplateRepository->getAll())
        );

        return new ReservationTemplateGetListResponse($templateModels);
    }
}
