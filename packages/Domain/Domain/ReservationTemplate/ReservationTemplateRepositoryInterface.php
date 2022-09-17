<?php

declare(strict_types=1);

namespace packages\Domain\Domain\ReservationTemplate;

interface ReservationTemplateRepositoryInterface
{
    /**
     * 予約テンプレートの保存を行う。
     *
     * @param ReservationTemplate $reservationTemplate
     *
     * @return void
     */
    public function insert(ReservationTemplate $reservationTemplate): void;
}
