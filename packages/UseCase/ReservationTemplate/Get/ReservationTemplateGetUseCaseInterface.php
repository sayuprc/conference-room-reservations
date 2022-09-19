<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Get;

interface ReservationTemplateGetUseCaseInterface
{
    /**
     * 予約テンプレートを取得する。
     *
     * @param ReservationTemplateGetRequest $request
     *
     * @return ReservationTemplateGetResponse
     */
    public function handle(ReservationTemplateGetRequest $request): ReservationTemplateGetResponse;
}
