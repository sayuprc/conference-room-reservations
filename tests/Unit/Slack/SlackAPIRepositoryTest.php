<?php

declare(strict_types=1);

namespace Tests\Unit\Slack;

use GuzzleHttp\Client;
use packages\Infrastructure\Slack\SlackAPIRepository;
use Tests\TestCase;

class SlackAPIRepositoryTest extends TestCase
{
    public function testRepository()
    {
        $repository = new SlackAPIRepository(new Client());

        $this->assertTrue($repository->postMessage('<!channel> hogehoge'));
    }
}
