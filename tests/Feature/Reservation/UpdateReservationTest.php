<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use DateTime;
use Tests\TestCase;

class UpdateReservationTest extends TestCase
{
    /**
     * 予約更新成功テスト
     *
     * @return void
     */
    public function testUpdateReservation(): void
    {
        $room = Room::with('reservations')->first();
        $reservation = $room->reservations()->first();

        $reservation->summary = '更新する';

        $response = $this->post('/reservations/update', [
            'room_id' => $room->room_id,
            'reservation_id' => $reservation->reservation_id,
            'summary' => $reservation->summary,
            'start_at_date' => (new DateTime($reservation->start_at))->format('Y-m-d'),
            'start_at_time' => (new DateTime($reservation->start_at))->format('H:i'),
            'end_at_date' => (new DateTime($reservation->end_at))->format('Y-m-d'),
            'end_at_time' => (new DateTime($reservation->end_at))->format('H:i'),
            'note' => $reservation->note,
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約の更新が完了しました。');
    }

    /**
     * 予約更新失敗テスト
     *
     * @return void
     */
    public function testFailureUpdateReservation(): void
    {
        $room = Room::with('reservations')->first();
        $reservation = $room->reservations()->first();

        $from = sprintf('/reservatinos/show/%s/%s', $room->room_id, $reservation->reservation_id);

        $reservation->summary = '更新する';

        $response = $this->from($from)->post('/reservations/update', [
            'room_id' => $room->room_id,
            'reservation_id' => '', // 予約IDがない
            'summary' => $reservation->summary,
            'start_at_date' => (new DateTime($reservation->start_at))->format('Y-m-d'),
            'start_at_time' => (new DateTime($reservation->start_at))->format('H:i'),
            'end_at_date' => (new DateTime($reservation->end_at))->format('Y-m-d'),
            'end_at_time' => (new DateTime($reservation->end_at))->format('H:i'),
            'note' => $reservation->note,
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['reservation_id']);
    }
}