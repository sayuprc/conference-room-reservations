<?php

declare(strict_types=1);

namespace packages\InMemoryInfrastructure\Slack;

use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;

class InMemorySlackAPIRepository implements SlackAPIRepositoryInterface
{
    /**
     * Slackeへメッセージ送信
     *
     * @param string $message
     *
     * @return bool
     */
    public function postMessage(string $message): bool
    {
        // モック用なので成功したことにする。
        return true;
    }
}
