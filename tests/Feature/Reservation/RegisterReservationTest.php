<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use Tests\Feature\FeatureTestCase;

class RegisterReservationTest extends FeatureTestCase
{
    /**
     * 登録画面表示
     *
     * @return void
     */
    public function testShowRegisterView(): void
    {
        $response = $this->get(route('reservations.register', [
            'room_id' => Room::get()->first()->room_id,
        ]));

        $response->assertStatus(200);
    }

    /**
     * 予約登録成功テスト
     *
     * @return void
     */
    public function testRegisterReservation(): void
    {
        $response = $this->post('/reservations/register', [
            'room_id' => Room::get()->first()->room_id,
            'summary' => '予約登録テスト',
            'start_at_date' => '2022-10-01',
            'start_at_time' => '13:00',
            'end_at_date' => '2022-10-01',
            'end_at_time' => '14:00',
            'note' => 'テスト備考',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約の登録が完了しました。');

        $response = $this->post('/reservations/register', [
            'room_id' => Room::get()->first()->room_id,
            'summary' => '予約登録テスト',
            'start_at_date' => '2022-10-01',
            'start_at_time' => '14:00',
            'end_at_date' => '2022-10-01',
            'end_at_time' => '15:00',
            'note' => 'テスト備考',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約の登録が完了しました。');
    }

    /**
     * 予約登録失敗テスト
     *
     * @return void
     */
    public function testFailureRegisterReservation(): void
    {
        $roomId = Room::get()->first()->room_id;

        $from = '/reservatinos/register?room_id=' . $roomId;

        $response = $this
            ->from($from)
            ->post('/reservations/register', [
                'room_id' => $roomId,
                'summary' => '', // 概要がない
                'start_at_date' => '2022-10-01',
                'start_at_time' => '13:00',
                'end_at_date' => '2022-10-01',
                'end_at_time' => '14:00',
                'note' => 'テスト備考',
            ]);

        $response->assertStatus(302)->assertLocation($from);

        $response = $this
            ->from($from)
            ->post('/reservations/register', [
                'room_id' => $roomId,
                'summary' => '概要',
                'start_at_date' => '2022-10-02', // 日付が逆転
                'start_at_time' => '13:00',
                'end_at_date' => '2022-10-01',
                'end_at_time' => '14:00',
                'note' => 'テスト備考',
            ]);

        $response->assertStatus(302)->assertLocation($from);
    }
}
