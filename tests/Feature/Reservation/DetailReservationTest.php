<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use Tests\TestCase;

class DetailReservationTest extends TestCase
{
    /**
     * テスト用会議室取得
     *
     * @return Room
     */
    public function getTestRoom(): Room
    {
        return Room::with('reservations')->where('room_id', '=', '2')->first();
    }

    /**
     * 予約の詳細画面表示テスト
     *
     * @return void
     */
    public function testShowReservationDetail(): void
    {
        $room = $this->getTestRoom();

        $response = $this->get(
            sprintf('/reservations/show/%s', $room->reservations()->first()->reservation_id)
        );

        $response->assertStatus(200);
    }

    /**
     * 予約の詳細画面表示失敗テスト(存在しないID)
     *
     * @return void
     */
    public function testFailureShowReservationDetail(): void
    {
        $response = $this->get('/reservations/show/hogefugapiyo');

        $response->assertStatus(302);
    }
}
