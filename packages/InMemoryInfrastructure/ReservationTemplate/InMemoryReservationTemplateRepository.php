<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\ReservationTemplate;

use DateTime;
use packages\Domain\Domain\Reservation\EndAt;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\StartAt;
use packages\Domain\Domain\Reservation\Summary;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplate;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\TemplateId;

class InMemoryReservationTemplateRepository implements ReservationTemplateRepositoryInterface
{
    /**
     * @var array<int, ReservationTemplate> $db
     */
    private array $db;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->db = [];

        foreach (range(1, 20) as $i) {
            $this->db[$i] = new ReservationTemplate(
                new TemplateId($i),
                new Summary('テンプレート概要 ' . $i),
                new StartAt((new DateTime())),
                new EndAt((new DateTime())->modify('+30 minutes')),
                new Note('テンプレート備考 ' . $i)
            );
        }
    }

    /**
     * 予約テンプレートの保存を行う。
     *
     * @param ReservationTemplate $reservationTemplate
     *
     * @return void
     */
    public function insert(ReservationTemplate $reservationTemplate): void
    {
        $latest = array_key_last($this->db);

        $nextIndex = $latest + 1;
        
        $this->db[$nextIndex] = $reservationTemplate;
    }

    /**
     * 予約テンプレートの更新を行う。
     *
     * @param ReservationTemplate $reservationTemplate
     *
     * @return void
     */
    public function update(ReservationTemplate $reservationTemplate): void
    {
        $this->db[$reservationTemplate->getTemplateId()->getValue()] = $reservationTemplate;
    }

    /**
     * 予約テンプレートすべてを取得する。
     *
     * @return array<ReservationTemplate>
     */
    public function getAll(): array
    {
        return array_map(fn (ReservationTemplate $t) => $t, $this->db);
    }

    /**
     * 予約テンプレートを検索する。
     *
     * @param TemplateId $templateId
     *
     * @return ReservationTemplate|null
     */
    public function find(TemplateId $templateId): ?ReservationTemplate
    {
        $found = $this->db[$templateId->getValue()] ?? null;

        return $found;
    }
}
