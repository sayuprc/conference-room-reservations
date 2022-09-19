<?php

declare(strict_types=1);

namespace Tests\Feature\ReservationTemplate;

use Tests\Feature\FeatureTestCase;

class IndexReservationTemplateTest extends FeatureTestCase
{
    /**
     * 予約テンプレート一覧画面のテスト
     *
     * @return void
     */
    public function testShowTemplateIndex(): void
    {
        $response = $this->get(route('templates.index'));

        $response->assertStatus(200);

        $response->assertViewHas('templates');

        $templates = $response->original['templates'];

        $this->assertTrue(3 <= $templates);
    }
}
