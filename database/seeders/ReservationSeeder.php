<?php

declare(strict_types=1);

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // テストデータ挿入前にすべて削除。
        DB::table('reservations')->delete();

        DB::table('reservations')->insert([
            // 新規作成用
            [
                'room_id' => '1',
                'reservation_id' => '1',
                'summary' => '概要 1',
                'start_at' => (new DateTime())->format('Y/m/d H:i:s'),
                'end_at' => (new DateTime())->modify('+30 minutes')->format('Y/m/d H:i:s'),
                'note' => '備考 1',
            ],
            // 更新用
            [
                'room_id' => '2',
                'reservation_id' => '2',
                'summary' => '概要 2',
                'start_at' => (new DateTime())->format('Y/m/d H:i:s'),
                'end_at' => (new DateTime())->modify('+30 minutes')->format('Y/m/d H:i:s'),
                'note' => '備考 2',
            ],
            [
                'room_id' => '2',
                'reservation_id' => '3',
                'summary' => '概要 3',
                'start_at' => (new DateTime())->modify('+60 minutes')->format('Y/m/d H:i:s'),
                'end_at' => (new DateTime())->modify('+90 minutes')->format('Y/m/d H:i:s'),
                'note' => '備考 3',
            ],
            // 削除用
            [
                'room_id' => '3',
                'reservation_id' => '4',
                'summary' => '概要 4',
                'start_at' => (new DateTime())->format('Y/m/d H:i:s'),
                'end_at' => (new DateTime())->modify('+30 minutes')->format('Y/m/d H:i:s'),
                'note' => '備考 4',
            ],
            [
                'room_id' => '3',
                'reservation_id' => '5',
                'summary' => '概要 5',
                'start_at' => (new DateTime())->modify('+60 minutes')->format('Y/m/d H:i:s'),
                'end_at' => (new DateTime())->modify('+90 minutes')->format('Y/m/d H:i:s'),
                'note' => '備考 5',
            ],
        ]);
    }
}
