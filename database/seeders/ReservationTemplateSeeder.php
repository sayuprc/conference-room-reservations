<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // テストデータ挿入前にすべて削除。
        DB::table('reservation_templates')->delete();

        DB::table('reservation_templates')->insert([
            [
                'summary' => '概要 1',
                'start_at' => '00:00',
                'end_at' => '00:30',
                'note' => '備考 1',
            ],
            [
                'summary' => '概要 2',
                'start_at' => '01:00',
                'end_at' => '01:30',
                'note' => '備考 2',
            ],
            [
                'summary' => '概要 3',
                'start_at' => '02:00',
                'end_at' => '02:30',
                'note' => '備考 3',
            ],
        ]);
    }
}
