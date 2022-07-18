<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use Tests\TestCase;

class DetailReservationTest extends TestCase
{
    /**
     * 予約の詳細画面表示テスト
     *
     * @return void
     */
    public function testShowReservationDetail(): void
    {
        $room = Room::get()->first();

        $response = $this->get(
            sprintf('/reservations/show/%s/%s', $room->room_id, $room->reservations()->first()->reservation_id)
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
        $room = Room::get()->first();

        $response = $this->get(sprintf('/reservations/show/%s/hogefugapiyo', $room->room_id));

        $response->assertStatus(302);
    }
}
