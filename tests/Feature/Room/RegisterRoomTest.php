<?php

declare(strict_types=1);

namespace Tests\Feature\Room;

use Tests\TestCase;

class RegisterRoom extends TestCase
{
    /**
     * 会議室登録画面表示テスト
     *
     * @return void
     */
    public function testShowRegister()
    {
        $response = $this->get('/rooms/register');

        $response->assertStatus(200);
    }

    /**
     * 会議室登録テスト
     *
     * @return void
     */
    public function testRegister()
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
    public function testFailureRegister()
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
