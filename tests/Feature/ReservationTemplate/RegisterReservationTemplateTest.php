<?php

declare(strict_types=1);

namespace Tests\Feature\ReservationTemplate;

use Tests\Feature\FeatureTestCase;

class RegisterReservationTemplateTest extends FeatureTestCase
{
    /**
     * テンプレート登録URL
     */
    private const POST_URL = '/templates/register';

    /**
     * テンプレート登録画面表示
     *
     * @return void
     */
    public function testShowRegisterView(): void
    {
        $response = $this->get(self::POST_URL);

        $response->assertStatus(200);
    }

    /**
     * 予約テンプレート登録成功テスト
     *
     * @return void
     */
    public function testRegisterReservationTemplate(): void
    {
        $response = $this->post(self::POST_URL, [
            'summary' => '予約テンプレート登録テスト',
            'start_at' => '13:00',
            'end_at' => '14:00',
            'note' => 'テスト備考',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', '予約テンプレートの登録が完了しました。');

        $response = $this->post(self::POST_URL, [
            'summary' => '予約テンプレート登録テスト',
            'start_at' => '14:00',
            'end_at' => '15:00',
            'note' => 'テスト備考',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', '予約テンプレートの登録が完了しました。');
    }

    /**
     * 予約テンプレート登録失敗テスト
     *
     * @return void
     */
    public function testFailureRegisterReservationTemplate(): void
    {
        $from = self::POST_URL;

        $response = $this
            ->from($from)
            ->post(self::POST_URL, [
                'summary' => '', // 概要がない
                'start_at' => '13:00',
                'end_at' => '14:00',
                'note' => 'テスト備考',
            ]);

        $response->assertStatus(302)->assertLocation($from);

        $response = $this
            ->from($from)
            ->post(self::POST_URL, [
                'summary' => '概要',
                'start_at' => '15:00', // 日付が逆転
                'end_at' => '14:00',
                'note' => 'テスト備考',
            ]);

        $response->assertStatus(302)->assertLocation($from);
    }
}
