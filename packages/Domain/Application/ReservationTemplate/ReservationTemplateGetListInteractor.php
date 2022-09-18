<?php

declare(strict_types=1);

namespace packages\Domain\Application\ReservationTemplate;

use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListRequest;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListResponse;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListUseCaseInterface;

class ReservationTemplateGetListInteractor implements ReservationTemplateGetListUseCaseInterface
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
            $this->reservationTemplateRepository->getAll()
        );

        return new ReservationTemplateGetListResponse($templateModels);
    }
}
