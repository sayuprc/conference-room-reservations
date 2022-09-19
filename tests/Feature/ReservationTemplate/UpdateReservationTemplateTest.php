<?php

declare(strict_types=1);

namespace Tests\Feature\ReservationTemplate;

use App\Models\ReservationTemplate as EloquentReservationTemplate;
use DateTime;
use Tests\Feature\FeatureTestCase;

class UpdateReservationTemplateTest extends FeatureTestCase
{
    /**
     * 予約テンプレート更新成功テスト
     *
     * @return void
     */
    public function testUpdateReservationTemplate(): void
    {
        $template = EloquentReservationTemplate::first();

        $template->summary = '更新する';

        $response = $this->post('/templates/update', [
            'template_id' => $template->template_id,
            'summary' => $template->summary,
            'start_at' => (new DateTime($template->start_at))->format('H:i'),
            'end_at' => (new DateTime($template->end_at))->format('H:i'),
            'note' => $template->note,
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約テンプレートの更新が完了しました。');
    }

    /**
     * 予約テンプレート更新失敗テスト
     *
     * @return void
     */
    public function testFailureUpdateReservationTemplate(): void
    {
        $template = EloquentReservationTemplate::first();

        $from = sprintf('/templates/show/%s', $template->template_id);

        $template->summary = '更新する';

        $response = $this->from($from)->post('/templates/update', [
            'template_id' => null, // IDがない
            'summary' => $template->summary,
            'start_at' => (new DateTime($template->start_at))->format('H:i'),
            'end_at' => (new DateTime($template->end_at))->format('H:i'),
            'note' => $template->note,
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['template_id']);
    }
}
