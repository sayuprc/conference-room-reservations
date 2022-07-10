<?php

declare(strict_types=1);

namespace Tests\Feature\Room;

use Tests\TestCase;

class IndexRoomTest extends TestCase
{
    /**
     * 会議室一覧画面のテスト
     *
     * @return void
     */
    public function testShowIndex()
    {
        $response = $this->get('/rooms');

        $response->assertStatus(200);

        $response->assertViewHas('rooms');

        $rooms = $response->original['rooms'];

        $this->assertCount(2, $rooms);
    }
}
