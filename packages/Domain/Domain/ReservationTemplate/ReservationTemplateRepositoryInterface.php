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

    /**
     * 予約テンプレートの更新を行う。
     *
     * @param ReservationTemplate $reservationTemplate
     *
     * @return void
     */
    public function update(ReservationTemplate $reservationTemplate): void;

    /**
     * 予約テンプレートすべてを取得する。
     *
     * @return array<ReservationTemplate>
     */
    public function getAll(): array;

    /**
     * 予約テンプレートを検索する。
     *
     * @param TemplateId $templateId
     *
     * @return ReservationTemplate|null
     */
    public function find(TemplateId $templateId): ?ReservationTemplate;
}
