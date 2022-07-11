<?php

declare(strict_types=1);

namespace Tests\Feature\Room;

use Tests\TestCase;

class DetailRoomTest extends TestCase
{
    /**
     * 会議室の詳細閲覧テスト
     *
     * @return void
     */
    public function testShowRoomDetail()
    {
        $response = $this->get('/rooms/show/1');

        $response->assertStatus(200);
    }
}