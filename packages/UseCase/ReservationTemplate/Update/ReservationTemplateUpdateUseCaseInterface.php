<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Update;

interface ReservationTemplateUpdateUseCaseInterface
{
    /**
     * 予約テンプレートの更新を行う。
     *
     * @param ReservationTemplateUpdateRequest $request
     *
     * @return ReservationTemplateUpdateResponse
     */
    public function handle(ReservationTemplateUpdateRequest $request): ReservationTemplateUpdateResponse;
}
