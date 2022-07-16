<?php

declare(strict_types=1);

namespace Tests\Feature\Room;

use Tests\Feature\FeatureTestCase;

class DetailRoomTest extends FeatureTestCase
{
    /**
     * 会議室の詳細閲覧テスト
     *
     * @return void
     */
    public function testShowRoomDetail(): void
    {
        $response = $this->get('/rooms/show/1');

        $response->assertStatus(200);
    }
}
