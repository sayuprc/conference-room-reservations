<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use Tests\TestCase;

class DeleteReservationTest extends TestCase
{
    /**
     * 予約削除成功テスト
     *
     * @return void
     */
    public function testDeleteReservation(): void
    {
        $room = Room::with('reservations')->first();

        $reservation = $room->reservations()->first();

        $response = $this->post('/reservations/delete', [
            'room_id' => $room->room_id,
            'reservation_id' => $reservation->reservation_id,
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約を削除しました。');
    }

    /**
     * 予約削除失敗テスト
     *
     * @return void
     */
    public function testFailureDeleteReservation(): void
    {
        $room = Room::with('reservations')->first();
        $reservation = $room->reservations()->first();

        $from = sprintf('/reservatinos/show/%s/%s', $room->room_id, $reservation->reservation_id);

        $response = $this->from($from)->post('/reservations/delete', [
            'room_id' => $room->room_id,
            'reservation_id' => '', // 予約IDがない
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['reservation_id']);
    }
}
