<?php

declare(strict_types=1);

namespace packages\Domain\Domain\ReservationTemplate;

class ReservationTemplateSpecification
{
    /**
     * 予約テンプレートの配列を並び替える。
     * テンプレートIDの昇順で並び替える。
     *
     * **パフォーマンスが悪いと感じた場合、このクラスは利用せずに、リポジトリでソートする**
     *
     * @param array<ReservationTemplate> $templates
     *
     * @return array<ReservationTemplate>
     */
    public function orderByTemplateIdAsc(array $templates): array
    {
        usort($templates, function (ReservationTemplate $a, ReservationTemplate $b): int {
            return $a->getTemplateId()->getValue() <=> $b->getTemplateId()->getValue();
        });

        return $templates;
    }
}
