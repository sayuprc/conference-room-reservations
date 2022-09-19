<?php

declare(strict_types=1);

namespace Tests\Feature\ReservationTemplate;

use App\Models\ReservationTemplate;
use Tests\Feature\FeatureTestCase;

class GetReservationTemplateTest extends FeatureTestCase
{
    /**
     * 予約テンプレートの詳細画面表示テスト
     *
     * @return void
     */
    public function testShowReservationTestDetail(): void
    {
        $response = $this->get(sprintf('/templates/show/%s', ReservationTemplate::first()->template_id));

        $response->assertStatus(200);
    }

    /**
     * 予約テンプレートの詳細画面表示失敗テスト(存在しないID)
     *
     * @return void
     */
    public function testFailureShowReservationTemplateDetail(): void
    {
        $response = $this->get('/templates/show/hogefugapiyo');

        $response->assertStatus(302);
    }
}
