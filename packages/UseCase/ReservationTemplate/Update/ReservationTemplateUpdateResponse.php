<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Update;

class ReservationTemplateUpdateResponse
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
     * 更新した予約テンプレートのIDを取得する。
     *
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }
}
