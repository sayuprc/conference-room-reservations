<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テストデータ挿入前にデータをすべて削除する。
        DB::table('rooms')->delete();

        DB::table('rooms')->insert([
            ['room_id' => '1', 'name' => '予約新規作成用'],
            ['room_id' => '2', 'name' => '予約更新用'],
            ['room_id' => '3', 'name' => '予約削除用'],
            ['room_id' => '4', 'name' => '予約付け替え用'],
        ]);
    }
}
