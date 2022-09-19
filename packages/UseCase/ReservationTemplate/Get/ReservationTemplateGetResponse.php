<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\Get;

use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;

class ReservationTemplateGetResponse
{
    /**
     * @var ReservationTemplateModel $template
     */
    private ReservationTemplateModel $template;

    /**
     * @param ReservationTemplateModel $template
     *
     * @return void
     */
    public function __construct(ReservationTemplateModel $template)
    {
        $this->template = $template;
    }

    /**
     * 予約テンプレートを取得する。
     *
     * @return ReservationTemplateModel
     */
    public function getTemplate(): ReservationTemplateModel
    {
        return $this->template;
    }
}
