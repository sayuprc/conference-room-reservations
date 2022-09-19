<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Get;

class ReservationTemplateGetRequest
{
    /**
     * @var int $templateId
     */
    private int $templateId;

    /**
     * @param int $templateId
     *
     * @return void
     */
    public function __construct(int $templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * 予約テンプレートIDを取得する。
     *
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }
}
