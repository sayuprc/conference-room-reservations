<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\GetList;

interface ReservationTemplateGetListUseCaseInterface
{
    /**
     * 予約テンプレートの一覧取得を行う。
     *
     * @param ReservationTemplateGetListRequest $request
     *
     * @return ReservationTemplateGetListResponse
     */
    public function handle(ReservationTemplateGetListRequest $request): ReservationTemplateGetListResponse;
}
