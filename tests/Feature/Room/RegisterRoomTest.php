<?php

declare(strict_types=1);

namespace Tests\Feature\Room;

use Tests\Feature\FeatureTestCase;

class RegisterRoomTest extends FeatureTestCase
{
    /**
     * 会議室登録画面表示テスト
     *
     * @return void
     */
    public function testShowRegister(): void
    {
        $response = $this->get('/rooms/register');

        $response->assertStatus(200);
    }

    /**
     * 会議室登録テスト
     *
     * @return void
     */
    public function testRegister(): void
    {
        $response = $this->post(
            '/rooms/register',
            ['name' => 'hogehoge']
        );

        $response->assertStatus(302);

        $response->assertSessionHas('message', '会議室を登録しました。');
    }

    /**
     * 会議室登録失敗テスト
     *
     * @return void
     */
    public function testFailureRegister(): void
    {
        $response = $this
            ->from('/rooms/register')
            ->post(
                '/rooms/register',
                ['name' => '']
            );
        $response->assertStatus(302)->assertLocation('/rooms/register');

        $response = $this
            ->from('/rooms/register')
            ->post(
                '/rooms/register',
                ['name' => str_repeat('a', 65)]
            );
        $response->assertStatus(302)->assertLocation('/rooms/register');
    }
}
