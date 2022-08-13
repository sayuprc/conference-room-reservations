<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Slack;

interface SlackAPIRepositoryInterface
{
    /**
     * Slackeへメッセージ送信
     *
     * @param string $message
     *
     * @return bool
     */
    public function postMessage(string $message): bool;
}
