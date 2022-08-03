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

        DB::table('reservations')->insert(
            array_map(function (int $i): array {
                $id = $i % 2 === 0 ? '1' : '2';
                return [
                    'room_id' => $id,
                    'reservation_id' => (string)$i,
                    'summary' => '概要 ' . (string)$i,
                    'start_at' => (new DateTime())->format('Y/m/d H:i:s'),
                    'end_at' => (new DateTime())->modify('+30 minutes')->format('Y/m/d H:i:s'),
                    'note' => '備考 ' . (string)$i,
                ];
            }, range(1, 12)),
        );
    }
}
