<?php

declare(strict_types=1);

namespace packages\Infrastructure\ReservationTemplate;

use App\Models\ReservationTemplate as EloquentReservationTemplate;
use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\TemplateId;

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

    /**
     * 予約テンプレートすべてを取得する。
     *
     * @return array<ReservationTemplate>
     */
    public function getAll(): array
    {
        $templates = EloquentReservationTemplate::all()->map(
            function (EloquentReservationTemplate $template): ReservationTemplate {
                return new ReservationTemplate(
                    new TemplateId($template->template_id),
                    new Summary($template->summary),
                    new StartAt(new DateTime($template->start_at)),
                    new EndAt(new DateTime($template->end_at)),
                    new Note($template->note)
                );
            }
        );

        return $templates->toArray();
    }
}
