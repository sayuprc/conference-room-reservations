<?php

declare(strict_types=1);

namespace packages\UseCase\ReservationTemplate\GetList;

use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;

class ReservationTemplateGetListResponse
{
    /**
     * @var array<ReservationTemplateModel> $templates
     */
    public array $templates;

    /**
     * @param array<ReservationTemplateModel> $templates
     *
     * @return void
     */
    public function __construct(array $templates)
    {
        $this->templates = $templates;
    }
}
