<?php

declare(strict_types=1);

namespace packages\Infrastructure\ReservationTemplate;

use App\Models\ReservationTemplate as EloquentReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;

class ReservationTemplateRepository implements ReservationTemplateRepositoryInterface
{
    /**
     * 予約テンプレートの保存を行う。
     *
     * @param ReservationTemplate $reservationTemplate
     *
     * @return void
     */
    public function insert(ReservationTemplate $reservationTemplate): void
    {
        $newTemplate = new EloquentReservationTemplate([
            'summary' => $reservationTemplate->getSummary()->getValue(),
            'start_at' => $reservationTemplate->getStartAt()->getValue()->format('H:i'),
            'end_at' => $reservationTemplate->getEndAt()->getValue()->format('H:i'),
            'note' => $reservationTemplate->getNote()->getValue(),
        ]);

        $newTemplate->save();
    }
}
