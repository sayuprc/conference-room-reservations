<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Register;

interface ReservationTemplateRegisterUseCaseInterface
{
    /**
     * 予約テンプレートの登録を行う。
     *
     * @param ReservationTemplateRegisterRequest $request
     *
     * @return ReservationTemplateRegisterResponse
     */
    public function handle(ReservationTemplateRegisterRequest $request): ReservationTemplateRegisterResponse;
}
