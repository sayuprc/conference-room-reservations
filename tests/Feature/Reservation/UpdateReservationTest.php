<?php

declare(strict_types=1);

namespace Tests\Feature\Reservation;

use App\Models\Room;
use DateTime;
use Tests\TestCase;

class UpdateReservationTest extends TestCase
{
    /**
     * テスト用会議室取得
     *
     * @return Room
     */
    private function getTestRoom(): Room
    {
        return Room::with('reservations')->where('room_id', '=', '2')->first();
    }

    /**
     * 予約更新成功テスト
     *
     * @return void
     */
    public function testUpdateReservation(): void
    {
        $room = $this->getTestRoom();
        $reservation = $room->reservations()->first();

        $reservation->summary = '更新する';

        $response = $this->post('/reservations/update', [
            'room_id' => $room->room_id,
            'reservation_id' => $reservation->reservation_id,
            'summary' => $reservation->summary,
            'start_at_date' => (new DateTime($reservation->start_at))->modify('+1 years')->format('Y-m-d'),
            'start_at_time' => (new DateTime($reservation->start_at))->modify('+1 years')->format('H:i'),
            'end_at_date' => (new DateTime($reservation->end_at))->modify('+2 years')->format('Y-m-d'),
            'end_at_time' => (new DateTime($reservation->end_at))->modify('+2 years')->format('H:i'),
            'note' => $reservation->note,
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('message', '予約の更新が完了しました。');

        // 会議室を変える
        $otherRoomId = Room::with('reservations')->where('room_id', '=', '4')->first()->room_id;
        $reservation = $room->reservations()->first();

        $reservation->room_id = $otherRoomId;
        $reservation->summary = '更新する';

        $response = $this->post('/reservations/update', [
            'room_id' => $reservation->room_id,
            'reservation_id' => $reservation->reservation_id,
            'summary' => $reservation->summary,
            'start_at_date' => (new DateTime($reservation->start_at))->modify('+1 years')->format('Y-m-d'),
            'start_at_time' => (new DateTime($reservation->start_at))->modify('+1 years')->format('H:i'),
            'end_at_date' => (new DateTime($reservation->end_at))->modify('+2 years')->format('Y-m-d'),
            'end_at_time' => (new DateTime($reservation->end_at))->modify('+2 years')->format('H:i'),
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
